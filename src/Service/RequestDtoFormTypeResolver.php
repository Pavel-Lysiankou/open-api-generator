<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Service;

class RequestDtoFormTypeResolver
{
    public function __construct(
        private readonly iterable $formTypes
    ) {
    }

    public function resolve(string $dtoClass): string
    {
        return $this->formTypes[$dtoClass];
    }
}
