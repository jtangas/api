<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 4/7/2017
 * Time: 2:18 PM
 */

namespace Jt\Api\Request\Service;


use Jt\Api\Request\Event\ApiEvent;

interface RequestServiceInterface
{
    public function executeRequest(ApiEvent $event);
}