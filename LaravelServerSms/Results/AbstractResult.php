<?php

namespace betterapp\LaravelServerSms\Results;

abstract class AbstractResult
{
    protected \StdClass | \SimpleXMLElement | null $result;
    
    abstract public function getResult();
    abstract public function setResult();
    
}