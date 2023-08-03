<?php

namespace betterapp\LaravelServerSms\Tests;

class AccountTest extends AbstractTest
{
    public function testAdd()
    {
        $params = array('phone' => '+48500600700', 'email' => 'mail@test.com', 'first_name' => 'John', 'last_name' => 'Doe', 'company' => 'Hello World');
        
        try {
            $r = $this->serverSms->account->add($params)->getResult();
            
            $this->assertObjectHasProperty('error', $r);
            $this->assertEquals(4312, $r->error->code);
        } catch (\Exception $e) {
            
        }
    }
    
    public function testLimits()
    {
        $r = $this->serverSms->account->limits()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
        $this->assertEquals('eco', $r->items[0]->type);
    }
    
    public function testHelp()
    {
        $r = $this->serverSms->account->help()->getResult();
        
        $this->assertObjectHasProperty('telephone', $r);
    }
    
    public function testMessages()
    {
        $r = $this->serverSms->account->messages()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
}