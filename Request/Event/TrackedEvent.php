<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 4/7/2017
 * Time: 1:48 PM
 */

namespace Jt\Api\Request\Event;


class TrackedEvent implements TrackedEventInterface
{
    protected $event;

    public function __construct($event)
    {
        $this->event = $event;
    }

    public function __toString()
    {
        return (is_array($this->event)) ? json_encode($this->event) : $this->event;
    }
}