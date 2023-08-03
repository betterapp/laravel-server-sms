<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Templates extends AbstractCommon
{
    /**
     * List of templates
     *
     * @param array $params
     *
     * @return AbstractResult
     * @throws \Exception
     * @option string "sort" Values: name
     * @option string "order" Values: asc|desc
     * @option array "items"
     * @option int "id"
     * @option string "name"
     * @option string "text"
     *
     */
    public function index(array $params = []): AbstractResult
    {
        return $this->master->call('templates/index', $params);
    }
    
    /**
     * Adding new template
     *
     * @param string $name
     * @param string $text
     *
     * @return AbstractResult
     * @option array
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function add(string $name, string $text): AbstractResult
    {
        $params = ['name' => $name, 'text' => $text];
        
        return $this->master->call('templates/add', $params);
    }
    
    /**
     * Editing a template
     *
     * @param int    $id
     * @param string $name
     * @param string $text
     *
     * @return AbstractResult
     * @option bool "success"
     * @option int "id"
     * @throws \Exception
     */
    public function edit(int $id, string $name, string $text): AbstractResult
    {
        $params = ['id' => $id, 'name' => $name, 'text' => $text];
        
        return $this->master->call('templates/edit', $params);
    }
    
    /**
     * Deleting a template
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
        
        return $this->master->call('templates/delete', $params);
    }
}
