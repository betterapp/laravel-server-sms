<?php

namespace betterapp\LaravelServerSms\Tests;

class MessagesTest extends AbstractTest
{
    public function testSendSms()
    {
        $r = $this->serverSms->messages->sendSms('500600700', 'Test message', 'INFORMACJA', array('test' => true, 'details' => true));
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testSendPersonalized()
    {
        $messages[] = array('phone' => '500600700', 'text' => 'First message');
        $messages[] = array('phone' => '600700800', 'text' => 'Second message');
        $r = $this->serverSms->messages->sendPersonalized($messages, 'INFORMACJA', array('test' => true, 'details' => true));
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testSendVoice()
    {
        $r = $this->serverSms->messages->sendVoice('500600700', array('text' => 'Test message', 'test' => true, 'details' => true));
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testSendMms()
    {
        $list = $this->serverSms->files->index('mms')->getResult();
        $r = $this->serverSms->messages->sendMms('500600700', 'MMS Title', array('test' => true, 'file_id' => $list->items[0]->id, 'details' => true))->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testView()
    {
        $list = $this->serverSms->messages->reports()->getResult();
        $r = $this->serverSms->messages->view($list->items[0]->id)->getResult();
        $this->assertObjectHasProperty('id', $r);
    }
    
    public function testReports()
    {
        $r = $this->serverSms->messages->reports()->getResult();
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testDelete()
    {
        $list = $this->serverSms->messages->reports()->getResult();
        $r = $this->serverSms->messages->delete($list->items[0]->id)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertFalse($r->success);
    }
    
    public function testRecived()
    {
        $r = $this->serverSms->messages->recived('nd')->getResult();
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testSendNd()
    {
        $r = $this->serverSms->messages->sendNd('500600700', 'TEST')->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertFalse($r->success);
    }
    
    public function testSendNdi()
    {
        $r = $this->serverSms->messages->sendNdi('500600700', 'Test message', '+48555666777')->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertFalse($r->success);
    }
}