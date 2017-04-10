<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/8/2017
 * Time: 10:49 PM
 */

namespace Jt\Api\Request\Event;


use Jt\Api\Request\Service\RequestServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiEvent
{
    public $response;
    protected $request;
    protected $trackedEvents = [];
    /** @var RequestServiceInterface $service */
    public $service;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getRequestBody()
    {
        return $this->request->request->all();
    }

    public function setResponse(JsonResponse $response)
    {
        $this->response = $response;
    }

    public function getResponse()
    {
        return $this->response;
    }

    public function addTrackedEvent(TrackedEvent $event)
    {
        $this->trackedEvents[] = $event;
    }
}