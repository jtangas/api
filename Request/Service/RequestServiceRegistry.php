<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 4/7/2017
 * Time: 2:18 PM
 */

namespace Jt\Api\Request\Service;


class RequestServiceRegistry
{
    protected $services;

    public function __construct()
    {
        $this->services = [];
    }

    public function all()
    {
        return $this->services;
    }

    public function has($name)
    {
        return array_key_exists($name, $this->services);
    }

    public function add($name, RequestServiceInterface $service)
    {
        $this->services[$name] = $service;
    }

    public function get($name)
    {
        if (!array_key_exists($name, $this->services)) {
            throw new \InvalidArgumentException("The Object requested does not exist. {$name}");
        }

        return $this->services[$name];
    }
}