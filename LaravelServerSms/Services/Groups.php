<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Groups extends AbstractCommon
{
    /**
     * Add new group
     *
     * @param string $name
     *
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function add(string $name): AbstractResult
    {
        $params = ['name' => $name];
        
        return $this->master->call('groups/add', $params);
    }
    
    /**
     * List of group
     *
     * @param ?string $search Group name
     * @param array   $params
     *
     * @option int "page" The number of the displayed page
     * @option int "limit" Limit items are displayed on the single page
     * @option string "sort" Values: name
     * @option string "order" Values: asc|desc
     * @return AbstractResult
     * @option array "paging"
     * @option int "page" The number of current page
     * @option int "count" The number of all pages
     * @option array "items"
     * @option int "id"
     * @option string "name"
     * @option int "count" Number of contacts in the group
     * @throws \Exception
     */
    public function index(?string $search = null, array $params = []): AbstractResult
    {
        $params = array_merge(['search' => $search], $params);
        
        return $this->master->call('groups/index', $params);
    }
    
    /**
     * View single group
     *
     * @param int $id
     *
     * @return AbstractResult
     * @option int "id"
     * @option string "name"
     * @option int "count" Number of contacts in the group
     * @throws \Exception
     */
    public function view(int $id): AbstractResult
    {
        $params = ['id' => $id];
        
        return $this->master->call('groups/view', $params);
    }
    
    /**
     * Editing a group
     *
     * @param int    $id
     * @param string $name
     *
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function edit(int $id, string $name): AbstractResult
    {
        $params = ['id' => $id, 'name' => $name];
        
        return $this->master->call('groups/edit', $params);
    }
    
    /**
     * Deleting a group
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
        
        return $this->master->call('groups/delete', $params);
    }
    
    /**
     * Viewing a groups containing phone
     *
     * @param string $phone
     *
     * @return AbstractResult
     * @option int "id"
     * @option int "group_id"
     * @option string "group_name"
     * @throws \Exception
     */
    public function check(string $phone): AbstractResult
    {
        $params = ['phone' => $phone];
        
        return $this->master->call('groups/check', $params);
    }
}
