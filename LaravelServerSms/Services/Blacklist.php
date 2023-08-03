<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Blacklist extends AbstractCommon
{
    /**
     * Add phone to the blacklist
     *
     * @param string $phone
     *
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function add(string $phone): AbstractResult
    {
        $params = ['phone' => $phone];
        
        return $this->master->call('blacklist/add', $params);
    }
    
    /**
     * List of blacklist phones
     *
     * @param ?string $phone
     * @param array   $params
     *
     * @option int "page" The number of the displayed page
     * @option int "limit" Limit items are displayed on the single page
     * @return AbstractResult
     * @option array "paging"
     * @option int "page" The number of current page
     * @option int "count" The number of all pages
     * @option array "items"
     * @option string "phone"
     * @option string "added" Date of adding phone
     * @throws \Exception
     */
    public function index(?string $phone = null, array $params = []): AbstractResult
    {
        $params = array_merge(['phone' => $phone], $params);
        
        return $this->master->call('blacklist/index', $params);
    }
    
    /**
     * Checking if phone is blacklisted
     *
     * @param string $phone
     *
     * @return AbstractResult
     * @option bool "exists"
     * @throws \Exception
     */
    public function check(string $phone): AbstractResult
    {
        $params = ['phone' => $phone];
        
        return $this->master->call('blacklist/check', $params);
    }
    
    /**
     * Deleting phone from the blacklist
     *
     * @param string $phone
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function delete(string $phone): AbstractResult
    {
        $params = ['phone' => $phone];
        
        return $this->master->call('blacklist/delete', $params);
    }
    
}
