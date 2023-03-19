<?php

declare(strict_types=1);

namespace PavelLysiankou\OpenApiGenerator\DependencyInjection\Compiler;

use PavelLysiankou\OpenApiGenerator\Service\RequestDtoFormTypeResolver;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class InjectRequestDtoFormTypesPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $servicesIds = $container->findTaggedServiceIds('open_api_generator.request_dto_type');
        $formTypes = [];

        foreach ($servicesIds as $formType => $tags) {
            $formTypes[$formType::getDtoClass()] = $formType;
        }

        $definition = $container->getDefinition(RequestDtoFormTypeResolver::class);
        $definition->setArgument('$formTypes', $formTypes);
    }
}