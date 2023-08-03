<?php

namespace betterapp\LaravelServerSms\Results;

class SimpleXmlResult extends AbstractResult
{
    /**
     * @param ?\SimpleXMLElement $result
     *
     * @return self
     */
    public function setResult(?\SimpleXMLElement $result = null) : self
    {
        $this->result = $result;
        
        return $this;
    }
    
    /**
     * @return ?\SimpleXMLElement
     */
    public function getResult() : ?\SimpleXMLElement
    {
        return $this->result;
    }
}