<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\Form\Type;

interface RequestDtoTypeInterface
{
    public static function getDtoClass(): string;
}
