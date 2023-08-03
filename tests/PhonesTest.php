<?php

namespace betterapp\LaravelServerSms\Tests;

class PhonesTest extends AbstractTest
{
    public function testCheck()
    {
        $r = $this->serverSms->phones->check('500600700')->getResult();
        
        $this->assertObjectHasProperty('phone', $r);
    }
    
    public function testTest()
    {
        $r = $this->serverSms->phones->test('500600700')->getResult();
        
        $this->assertObjectHasProperty('correct', $r);
        $this->assertTrue($r->correct);
    }
}