<?php

namespace betterapp\LaravelServerSms\Tests;

class ErrorTest extends AbstractTest
{
    public function testView()
    {
        try {
            $r = $this->serverSms->error->view(1000)->getResult();
            
            $this->assertObjectHasProperty('error', $r);
            $this->assertEquals(1000, $r->error->code);
        } catch (\Exception $e) {
            
        }
    }
}