<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Senders extends AbstractCommon
{
    /**
     * Creating new Sender name
     *
     * @param string $name
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function add(string $name): AbstractResult
    {
        $params = ['name' => $name];
        
        return $this->master->call('senders/add', $params);
    }
    
    /**
     * Senders list
     *
     * @param array $params
     *
     * @option bool "predefined"
     * @option string "sort" Values: name
     * @option string "order" Values: asc|desc
     * @return AbstractResult
     * @option array "items"
     * @option string "name"
     * @option string "agreement" delivered|required|not_required
     * @option string "status" pending_authorization|authorized|rejected|deactivated
     * @throws \Exception
     */
    public function index(array $params = []): AbstractResult
    {
        return $this->master->call('senders/index', $params);
    }
}
