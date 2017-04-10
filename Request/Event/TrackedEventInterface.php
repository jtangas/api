<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 4/7/2017
 * Time: 1:47 PM
 */

namespace Jt\Api\Request\Event;


interface TrackedEventInterface
{
    public function __construct($event);
    public function __toString();
}