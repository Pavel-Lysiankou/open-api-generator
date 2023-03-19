<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator;

use PavelLysiankou\OpenApiGenerator\DependencyInjection\OpenApiGeneratorExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class OpenApiGeneratorBundle extends AbstractBundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new OpenApiGeneratorExtension();
    }
}
