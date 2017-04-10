<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/8/2017
 * Time: 10:30 PM
 */

namespace Jt\Api;


use Jt\Api\DependencyInjection\Compiler\HandlerTransportPass;
use Jt\Api\DependencyInjection\Compiler\ServiceTransportPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JtApiBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ServiceTransportPass());
        $container->addCompilerPass(new HandlerTransportPass());
    }
}