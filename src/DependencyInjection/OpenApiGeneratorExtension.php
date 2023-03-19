<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\DependencyInjection;

use PavelLysiankou\OpenApiGenerator\DependencyInjection\Compiler\InjectRequestDtoFormTypesPass;
use PavelLysiankou\OpenApiGenerator\Form\Type\RequestDtoFormTypeInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class OpenApiGeneratorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $container
            ->registerForAutoconfiguration(RequestDtoFormTypeInterface::class)
            ->addTag(InjectRequestDtoFormTypesPass::REQUEST_DTO_FORM_TYPE_TAG);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
    }
}
