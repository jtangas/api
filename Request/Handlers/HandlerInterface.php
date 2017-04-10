<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/23/2017
 * Time: 9:46 PM
 */

namespace Jt\Api\Request\Handlers;


use Jt\Api\Request\Event\ApiEvent;
use Jt\Api\Request\Service\RequestServiceInterface;

interface HandlerInterface
{
    public function execute(ApiEvent $apiEvent, RequestServiceInterface $service);
}