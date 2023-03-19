<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Service;

use Symfony\Component\Form\FormInterface;

class RequestDtoTypeFactory
{
    public function __construct(
        private readonly iterable $types
    ) {
    }

    public function getType(string $dtoClass): FormInterface
    {
        return $this->types[$dtoClass];
    }
}
