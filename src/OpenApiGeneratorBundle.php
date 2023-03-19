<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator;

use PavelLysiankou\OpenApiGenerator\DependencyInjection\Compiler\InjectRequestDtoFormTypesPass;
use PavelLysiankou\OpenApiGenerator\DependencyInjection\OpenApiGeneratorExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class OpenApiGeneratorBundle extends AbstractBundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new InjectRequestDtoFormTypesPass());
    }

    public function getContainerExtension(): ?ExtensionInterface
    {
        return new OpenApiGeneratorExtension();
    }
}
