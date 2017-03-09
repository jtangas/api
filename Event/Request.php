<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/8/2017
 * Time: 10:40 PM
 */

namespace Jt\Api\Event;


use Jt\Api\Request\Event\ApiEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class Request implements RequestInterface
{
    public function __invoke(ApiEvent $apiEvent)
    {
        return new JsonResponse($apiEvent);
    }
}