<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Phones extends AbstractCommon
{
    /**
     * Checking phone in to HLR
     *
     * @param string  $phone
     * @param ?string $id Query ID returned if the processing takes longer than 60 seconds
     *
     * @return AbstractResult
     * @option string "phone"
     * @option string "status"
     * @option int "imsi"
     * @option string "network"
     * @option bool "ported"
     * @option string "network_ported"
     * @throws \Exception
     */
    public function check(string $phone, ?string $id = null): AbstractResult
    {
        $params = ['phone' => $phone, 'id' => $id];
        
        return $this->master->call('phones/check', $params);
    }
    
    /**
     * Validating phone number
     *
     * @param string $phone
     *
     * @return AbstractResult
     * @option bool "correct"
     * @throws \Exception
     */
    public function test(string $phone): AbstractResult
    {
        $params = ['phone' => $phone];
        
        return $this->master->call('phones/test', $params);
    }
}
