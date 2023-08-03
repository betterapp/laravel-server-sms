<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Account extends AbstractCommon
{
    /**
     * Register new account
     *
     * @param array $params
     *
     * @option string "phone"
     * @option string "email"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function add(array $params = []): AbstractResult
    {
        return $this->master->call('account/add', $params);
    }
    
    /**
     * Return limits SMS
     *
     * @param array $params
     *
     * @option bool "show_type"
     * @return AbstractResult
     * @option array "items"
     * @option string "type" Type of message
     * @option string "chars_limit" The maximum length of message
     * @option string "value" Limit messages
     *
     * @throws \Exception
     */
    public function limits(array $params = []): AbstractResult
    {
        return $this->master->call('account/limits', $params);
    }
    
    /**
     * Return contact details
     *
     * @return AbstractResult
     * @option string "telephone"
     * @option string "email"
     * @option string "form"
     * @option string "faq"
     * @option array "account_maintainer"
     * @option string "name"
     * @option string "email"
     * @option string "telephone"
     * @option string "photo"
     * @throws \Exception
     */
    public function help(): AbstractResult
    {
        return $this->master->call('account/help');
    }
    
    /**
     * Return messages from the administrator
     *
     * @return AbstractResult
     * @option bool "new" Marking unread message
     * @option string "message"
     * @throws \Exception
     */
    public function messages(): AbstractResult
    {
        return $this->master->call('account/messages');
    }
}
