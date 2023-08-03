<?php

namespace betterapp\LaravelServerSms\Tests;

class SendersTest extends AbstractTest
{
    public function testAdd()
    {
        $r = $this->serverSms->senders->add('NewSender')->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testIndex()
    {
        $r = $this->serverSms->senders->index(array('personalized' => true))->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
}