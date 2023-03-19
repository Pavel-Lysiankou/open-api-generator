<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\ArgumentResolver;

use PavelLysiankou\OpenApiGenerator\Dto\RequestDtoInterface;
use PavelLysiankou\OpenApiGenerator\Exception\ValidationException;
use PavelLysiankou\OpenApiGenerator\Service\RequestDtoTypeFactory;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;


#[AutoconfigureTag('controller.argument_value_resolver')]
class RequestDTOResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private readonly RequestDtoTypeFactory $requestDtoTypeFactory,
        private readonly ValidatorInterface $validator
    ) {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        $dtoClass = $argument->getType();

        return $dtoClass && is_subclass_of($dtoClass, RequestDtoInterface::class);
    }

    /**
     * @return iterable<RequestDtoInterface>
     *
     * @throws ValidationException
     */
    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $dtoClass = $argument->getType();

        $requestDto = $this->requestDtoTypeFactory
            ->getType($dtoClass)
            ->handleRequest($request)
            ->getData();

        $errors = $this->validator->validate($requestDto);

        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

        yield $requestDto;
    }
}