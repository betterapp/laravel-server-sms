<?php

namespace betterapp\LaravelServerSms\Tests;

class TemplatesTest extends AbstractTest
{
    public function testIndex()
    {
        $r = $this->serverSms->templates->index()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testAdd()
    {
        $r = $this->serverSms->templates->add('New template', 'Message from template')->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testEdit()
    {
        $list = $this->serverSms->templates->index()->getResult();
        $r = $this->serverSms->templates->edit($list->items[0]->id, 'New template', 'Editing message from template')->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testDelete()
    {
        $list = $this->serverSms->templates->index()->getResult();
        $r = $this->serverSms->templates->delete($list->items[0]->id)->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
}