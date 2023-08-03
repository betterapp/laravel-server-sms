<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class SubAccounts extends AbstractCommon
{
    /**
     * Creating new sub account
     *
     * @param string $subAccountUsername
     * @param string $subAccountPassword
     * @param int    $subAccountId Sub account ID, which is template of powers
     * @param array  $params
     *
     * @option string "name"
     * @option string "phone"
     * @option string "email"
     * @return AbstractResult
     * @throws \Exception
     */
    public function add(string $subAccountUsername, string $subAccountPassword, int $subAccountId, array $params = []): AbstractResult
    {
        $params = array_merge(['subaccount_username' => $subAccountUsername, 'subaccount_password' => $subAccountPassword, 'subaccount_id' => $subAccountId], $params);
        
        return $this->master->call('subaccounts/add', $params);
    }
    
    /**
     * List of subaccounts
     *
     * @return AbstractResult
     * @option array "items"
     * @option int "id"
     * @option string "username"
     * @throws \Exception
     */
    public function index(): AbstractResult
    {
        return $this->master->call('subaccounts/index');
    }
    
    /**
     * View details of subaccount
     *
     * @param int $id
     *
     * @return AbstractResult
     * @option int "id"
     * @option string "username"
     * @option string "name"
     * @option string "phone"
     * @option string "email"
     * @throws \Exception
     */
    public function view(int $id): AbstractResult
    {
        $params = ['id' => $id];
        
        return $this->master->call('subaccounts/view', $params);
    }
    
    /**
     * Setting the limit on subaccount
     *
     * @param int    $id
     * @param string $type Message type: eco|full|voice|mms|hlr
     * @param int    $value
     *
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function limit(int $id, string $type, int $value): AbstractResult
    {
        $params = ['id' => $id, 'type' => $type, 'value' => $value];
        
        return $this->master->call('subaccounts/limit', $params);
    }
    
    /**
     * Deleting a subaccount
     *
     * @param int $id
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function delete(int $id): AbstractResult
    {
        $params = ['id' => $id];
        
        return $this->master->call('subaccounts/delete', $params);
    }
}
