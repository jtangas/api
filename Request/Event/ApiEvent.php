<?php
/**
 * Created by PhpStorm.
 * User: jtang
 * Date: 3/8/2017
 * Time: 10:49 PM
 */

namespace Jt\Api\Request\Event;


use Symfony\Component\HttpFoundation\Request;

class ApiEvent
{
    public $response;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}