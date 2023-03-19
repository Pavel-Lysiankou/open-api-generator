<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Service;

use PavelLysiankou\OpenApiGenerator\Exception\RequestDtoFormTypeNotFoundException;

class RequestDtoFormTypeResolver
{
    public function __construct(
        private readonly iterable $formTypes
    ) {
    }

    public function resolve(string $dtoClass): string
    {
        if (isset($this->formTypes[$dtoClass])) {
            $this->formTypes[$dtoClass];
        }

        throw new RequestDtoFormTypeNotFoundException();
    }
}
