<?php

namespace betterapp\LaravelServerSms\Tests;

class FilesTest extends AbstractTest
{
    public function testAdd()
    {
        $params = array('url' => 'https://panel.serwersms.pl/demo/demo.wav', 'name' => 'Demo wav');
        $r = $this->serverSms->files->add('voice', $params)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testIndex()
    {
        $r = $this->serverSms->files->index('mms')->getResult();
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testView()
    {
        $list = $this->serverSms->files->index('mms')->getResult();
        $r = $this->serverSms->files->view($list->items[0]->id, 'mms')->getResult();
        $this->assertObjectHasProperty('id', $r);
    }
    
    public function testDelete()
    {
        $list = $this->serverSms->files->index('voice')->getResult();
        $r = $this->serverSms->files->delete($list->items[0]->id, 'voice')->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
}