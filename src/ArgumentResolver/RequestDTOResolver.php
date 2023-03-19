<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\ArgumentResolver;

use PavelLysiankou\OpenApiGenerator\Dto\RequestDtoInterface;
use PavelLysiankou\OpenApiGenerator\Exception\ValidationException;
use PavelLysiankou\OpenApiGenerator\Service\RequestDtoFormTypeResolver;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDTOResolver implements ArgumentValueResolverInterface
{
    public function __construct(
        private readonly FormFactoryInterface       $formFactory,
        private readonly RequestDtoFormTypeResolver $requestDtoFormTypeResolver,
        private readonly ValidatorInterface         $validator
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
        $formType = $this->requestDtoFormTypeResolver->resolve($dtoClass);

        $requestDto = $this->formFactory
            ->create($formType)
            ->handleRequest($request)
            ->getData();

        $errors = $this->validator->validate($requestDto);

        if ($errors->count() > 0) {
            throw new ValidationException($errors);
        }

        yield $requestDto;
    }
}