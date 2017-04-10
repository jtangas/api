<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 4/7/2017
 * Time: 1:56 PM
 */

namespace Jt\Api\Request\Handlers;


class HandlerRegistry
{
    protected $handlers;

    public function __construct()
    {
        $this->handlers = [];
    }

    public function all()
    {
        return $this->handlers;
    }

    public function has($name)
    {
        return array_key_exists($name, $this->handlers);
    }

    public function add($name, HandlerInterface $handler)
    {
        $this->handlers[$name] = $handler;
    }

    public function get($name)
    {
        if (!array_key_exists($name, $this->handlers)) {
            throw new \InvalidArgumentException("The Object requested does not exist. {$name}");
        }

        return $this->handlers[$name];
    }

}