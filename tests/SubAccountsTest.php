<?php

namespace betterapp\LaravelServerSms\Tests;

class SubAccountsTest extends AbstractTest
{
    public function testAdd()
    {
        try {
            $r = $this->serverSms->subAccounts->add('login', 'haslo', 123, array('phone' => '500600700'))->getResult();
            $this->assertObjectHasProperty('error', $r);
            $this->assertEquals(4500, $r->error->code);
        } catch (Exception $e) {
            
        }
    }
    
    public function testIndex()
    {
        $r = $this->serverSms->subAccounts->index()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testView()
    {
        try {
            $r = $this->serverSms->subAccounts->view(123)->getResult();
            $this->assertObjectHasProperty('error', $r);
            $this->assertEquals(1004, $r->error->code);
        } catch (Exception $e) {
            
        }
    }
    
    public function testLimit()
    {
        $r = $this->serverSms->subAccounts->limit(123, 'eco', 200)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertFalse($r->success);
    }
    
    public function testDelete()
    {
        $r = $this->serverSms->subAccounts->delete(123)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertFalse($r->success);
    }
}