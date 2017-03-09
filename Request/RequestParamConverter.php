<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/8/2017
 * Time: 10:43 PM
 */

namespace Jt\Api\Request;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class RequestParamConverter implements ParamConverterInterface
{
    public $commands = [];

    public $handlers;

    public function __construct(
        $handlers
    ) {
        $this->handlers = $handlers;
        $this->setCommandsAndValidate();
    }

    public function getCommands()
    {
        return ['handler'];
    }

    protected function getHandler(Request $request)
    {
        $method = $request->getMethod();
        $service = $this->handlers->get($method);
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $actionClassName    = $configuration->getClass();
        $methodName         = 'get' . str_replace('\\', '', $actionClassName);
        $action             = $this->{$methodName}($request);

        $tag = $configuration->getName();
        $request->attributes->set($tag, $action);

        return true;
    }

    public function supports(ParamConverter $configuration)
    {
        $truth = in_array($configuration->getclass(), $this->commands);

        return $truth;
    }

    protected function setParam(Request $request, $parameterName, $command)
    {
        $request->attributes->set($parameterName, $command);
    }

    private function setCommandsAndValidate()
    {
        $this->commands = $this->getCommands();
        foreach ($this->commands as $command) {
            $method = 'get' . str_replace('\\', '', $command);
            if (!method_exists($this, $method)) {
                throw new \Exception('Expected that ' . get_class($this) . ' would implement ' . $method);
            }
        }
    }

}