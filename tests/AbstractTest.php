<?php

namespace betterapp\LaravelServerSms\Tests;

use betterapp\LaravelServerSms\ServerSms;
use Tests\TestCase;

abstract class AbstractTest extends TestCase
{
    protected ServerSms $serverSms;
    
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->serverSms = new ServerSms(null, null, "demo", "demo");
    }
}