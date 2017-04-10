<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/23/2017
 * Time: 9:50 PM
 */

namespace Jt\Api\Request\Handlers;


use Jt\Api\Request\Event\ApiEvent;
use Jt\Api\Request\Service\RequestServiceInterface;

abstract class AbstractHandler implements HandlerInterface
{
    abstract public function execute(ApiEvent $apiEvent, RequestServiceInterface $service);
}