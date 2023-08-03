<?php

namespace betterapp\LaravelServerSms\Tests;

class PremiumTest extends AbstractTest
{
    public function testIndex()
    {
        $r = $this->serverSms->premium->index()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
    
    public function testSend()
    {
        try {
            $r = $this->serverSms->premium->send('500600700', 'Wiadomosc', 71200, 123456)->getResult();
            $this->assertObjectHasProperty('error', $r);
            $this->assertEquals(4201, $r->error->code);
        } catch (\Exception $e) {
            
        }
    }
    
    public function testQuiz()
    {
        try {
            $r = $this->serverSms->premium->quiz(123)->getResult();
            $this->assertObjectHasProperty('error', $r);
            $this->assertEquals(1004, $r->error->code);
        } catch (\Exception $e) {
            
        }
    }
}