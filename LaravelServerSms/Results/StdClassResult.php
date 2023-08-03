<?php

namespace betterapp\LaravelServerSms\Results;

class StdClassResult extends AbstractResult
{
    /**
     * @param ?\StdClass $result
     *
     * @return self
     */
    public function setResult(?\StdClass $result = null) : self
    {
        $this->result = $result;
        
        return $this;
    }
    
    /**
     * @return ?\StdClass
     */
    public function getResult() : ?\StdClass
    {
        return $this->result;
    }
}