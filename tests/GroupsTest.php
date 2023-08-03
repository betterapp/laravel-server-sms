<?php

namespace betterapp\LaravelServerSms\Tests;

class GroupsTest extends AbstractTest
{
    public function testAdd()
    {
        $r = $this->serverSms->groups->add('test')->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testIndex()
    {
        $r = $this->serverSms->groups->index()->getResult();
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testView()
    {
        $list = $this->serverSms->groups->index()->getResult();
        $r = $this->serverSms->groups->view($list->items[0]->id)->getResult();
        $this->assertObjectHasProperty('id', $r);
    }
    
    public function testEdit()
    {
        $list = $this->serverSms->groups->index()->getResult();
        $r = $this->serverSms->groups->edit($list->items[0]->id, 'New name')->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testDelete()
    {
        $list = $this->serverSms->groups->index()->getResult();
        $r = $this->serverSms->groups->delete($list->items[0]->id)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testCheck()
    {
        $r = $this->serverSms->groups->check('600700800')->getResult();
        $this->assertObjectHasProperty('items', $r);
    }
}