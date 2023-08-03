<?php

namespace betterapp\LaravelServerSms\Tests;

class BlacklistTest extends AbstractTest
{
    public function testAdd()
    {
        $r = $this->serverSms->blacklist->add('500600720')->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testIndex()
    {
        $r = $this->serverSms->blacklist->index()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testCheck()
    {
        $r = $this->serverSms->blacklist->check('500600720')->getResult();
        
        $this->assertObjectHasProperty('exists', $r);
        $this->assertTrue($r->exists);
    }
    
    public function testDelete()
    {
        $r = $this->serverSms->blacklist->delete('500600720')->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
}