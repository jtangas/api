<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 4/9/2017
 * Time: 12:26 PM
 */

namespace Jt\Api\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class HandlerTransportPass implements CompilerPassInterface

{

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('api_event_handler_registry')) {
            return;
        }

        $definition     = $container->findDefinition('api_event_handler_registry');
        $taggedServices = $container->findTaggedServiceIds('api_event.action');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('add', [$id, new Reference($id)]);
        }
    }
}