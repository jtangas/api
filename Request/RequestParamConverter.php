<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/8/2017
 * Time: 10:43 PM
 */

namespace Jt\Api\Request;


use Jt\Api\Request\Event\ApiEvent;
use Jt\Api\Request\Handlers\HandlerInterface;
use Jt\Api\Request\Handlers\HandlerRegistry;
use Jt\Api\Request\Service\RequestServiceInterface;
use Jt\Api\Request\Service\RequestServiceRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class RequestParamConverter implements ParamConverterInterface
{
    public $commands = [];

    /** @var HandlerRegistry $handlers */
    public $handlers;
    /** @var RequestServiceRegistry $requestServices */
    public $requestServices;

    public function __construct(
        $handlers,
        $requestServices
    ) {
        $this->handlers = $handlers;
        $this->requestServices = $requestServices;
        $this->setCommandsAndValidate();
    }

    public function getCommands()
    {
        return [
            ApiEvent::class
        ];
    }

    protected function getJtApiRequestEventApiEvent(Request $request)
    {
        $handlerAttr = $request->attributes->get('handler');
        $method = $request->getMethod();

        $handler = ($handlerAttr != null) ? $handlerAttr : 'api_event_handler.' . strtolower($method);
        $apiEvent = new ApiEvent($request);

        /** @var RequestServiceInterface $requestService */
        $requestService = $this->requestServices->get($request->attributes->get('entity'));

        /** @var HandlerInterface $service */
        $service = $this->handlers->get($handler);
        $service->execute($apiEvent, $requestService);

        return $apiEvent;
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