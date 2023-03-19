<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Form\Type;

interface RequestDtoFormTypeInterface
{
    public static function getDtoClass(): string;
}
