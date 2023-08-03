<?php

namespace betterapp\LaravelServerSms\Tests;

class PaymentsTest extends AbstractTest
{
    public function testIndex()
    {
        $r = $this->serverSms->payments->index()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testView()
    {
        $list = $this->serverSms->payments->index()->getResult();
        $r = $this->serverSms->payments->view($list->items[0]->id)->getResult();
        
        $this->assertObjectHasProperty('id', $r);
    }
    
}