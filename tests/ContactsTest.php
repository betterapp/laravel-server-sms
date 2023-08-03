<?php

namespace betterapp\LaravelServerSms\Tests;

class ContactsTest extends AbstractTest
{
    public function testAdd()
    {
        $params = array('email' => 'test@mail.com', 'first_name' => 'John', 'last_name' => 'Doe', 'company' => 'Hello Word!');
        
        $r = $this->serverSms->contacts->add(123, '500600800', $params)->getResult();
        
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testIndex()
    {
        $r = $this->serverSms->contacts->index()->getResult();
     
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testView()
    {
        $list = $this->serverSms->contacts->index()->getResult();
        $r = $this->serverSms->contacts->view($list->items[0]->id)->getResult();
        
        $this->assertObjectHasProperty('id', $r);
    }
    
    public function testEdit()
    {
        $list = $this->serverSms->contacts->index()->getResult();
        
        $params = array('email' => 'test@mail.com', 'first_name' => 'John', 'last_name' => 'Doe', 'company' => 'Hello Word!');
        
        $r = $this->serverSms->contacts->edit($list->items[0]->id, 123, '500600700', $params)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testDelete()
    {
        
        $list = $this->serverSms->contacts->index()->getResult();
        $r = $this->serverSms->contacts->delete($list->items[0]->id)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
    
    public function testImport()
    {
        $contact[] = array('phone' => '500600700', 'email' => 'test@mail.com', 'first_name' => 'John', 'last_name' => 'Doe', 'company' => 'Hello Word!');
        $contact[] = array('phone' => '500600800', 'email' => 'test@mail.com', 'first_name' => 'John', 'last_name' => 'Doe', 'company' => 'Hello Word!');
        
        $r = $this->serverSms->contacts->import('New group', $contact)->getResult();
        $this->assertObjectHasProperty('success', $r);
        $this->assertTrue($r->success);
    }
}