<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Contacts extends AbstractCommon
{
    /**
     * Add new contact
     *
     * @param int|array $groupId
     * @param string    $phone
     * @param array     $params
     *
     * @option string "email"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @option string "tax_id"
     * @option string "address"
     * @option string "city"
     * @option string "description"
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function add(int|array $groupId, string $phone, array $params = []): AbstractResult
    {
        $params = array_merge(['group_id' => $groupId, 'phone' => $phone,], $params);
        
        return $this->master->call('contacts/add', $params);
    }
    
    /**
     * List of contacts
     *
     * @param ?int    $groupId
     * @param ?string $search
     * @param array   $params
     *
     * @option  int "page" The number of the displayed page
     * @option  int "limit" Limit items are displayed on the single page
     * @option  string "sort" Values: first_name|last_name|phone|company|tax_id|email|address|city|description
     * @option  string "order" Values: asc|desc
     * @return AbstractResult
     * @option  array "paging"
     * @option  int "page" The number of current page
     * @option  int "count" The number of all pages
     * @options array "items"
     * @option  int "id"
     * @option  string "phone"
     * @option  string "email"
     * @option  string "company"
     * @option  string "first_name"
     * @option  string "last_name"
     * @option  string "tax_id"
     * @option  string "address"
     * @option  string "city"
     * @option  string "description"
     * @option  bool "blacklist"
     * @option  int "group_id"
     * @option  string "group_name"
     * @throws \Exception
     */
    public function index(?int $groupId = null, ?string $search = null, array $params = []): AbstractResult
    {
        $params = array_merge(['group_id' => $groupId, 'search' => $search], $params);
        
        return $this->master->call('contacts/index', $params);
    }
    
    /**
     * View single contact
     *
     * @param int $id
     *
     * @return AbstractResult
     * @option integer "id"
     * @option string "phone"
     * @option string "email"
     * @option string "company"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "tax_id"
     * @option string "address"
     * @option string "city"
     * @option string "description"
     * @option bool "blacklist"
     * @throws \Exception
     */
    public function view(int $id): AbstractResult
    {
        $params = ['id' => $id];
        
        return $this->master->call('contacts/view', $params);
    }
    
    /**
     * Editing a contact
     *
     * @param int       $id
     * @param int|array $groupId
     * @param string    $phone
     * @param array     $params
     *
     * @option string "email"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @option string "tax_id"
     * @option string "address"
     * @option string "city"
     * @option string "description"
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function edit(int $id, int|array $groupId, string $phone, array $params = []): AbstractResult
    {
        $params = array_merge(['id' => $id, 'group_id' => $groupId, 'phone' => $phone], $params);
        
        return $this->master->call('contacts/edit', $params);
    }
    
    /**
     * Deleting a phone from contacts
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
        
        return $this->master->call('contacts/delete', $params);
    }
    
    /**
     * Import contact list
     *
     * @param string $groupName
     * @param array  $contact []
     *
     * @option string "phone"
     * @option string "email"
     * @option string "first_name"
     * @option string "last_name"
     * @option string "company"
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @option int "correct" Number of contacts imported correctly
     * @option int "failed" Number of errors
     * @throws \Exception
     */
    public function import(string $groupName, array $contact): AbstractResult
    {
        $params = ['group_name' => $groupName, 'contact' => $contact];
        
        return $this->master->call('contacts/import', $params);
    }
}
