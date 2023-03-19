<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Service;

use Symfony\Component\Form\FormInterface;

class RequestDtoFormTypeResolver
{
    public function __construct(
        private readonly iterable $formTypes
    ) {
    }

    public function resolve(string $dtoClass): FormInterface
    {
        return $this->formTypes[$dtoClass];
    }
}
