<?php

namespace betterapp\LaravelServerSms\Tests;

class StatsTest extends AbstractTest
{
    public function testIndex()
    {
        $r = $this->serverSms->stats->index()->getResult();
        
        $this->assertObjectHasProperty('items', $r);
    }
}