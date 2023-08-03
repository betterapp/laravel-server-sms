<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\ServerSms;

abstract class AbstractCommon
{
    protected ServerSms $master;
    
    public function __construct(ServerSms $master)
    {
        $this->master = $master;
    }
}