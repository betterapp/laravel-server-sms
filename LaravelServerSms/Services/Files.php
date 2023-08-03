<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Files extends AbstractCommon
{
    /**
     * Add new file
     *
     * @param string $type - mms|voice
     * @param array  $params
     *
     * @option string "url" URL address to file
     * @option resource "file" A file handler (only for MMS)
     * @return AbstractResult
     * @option bool "success"
     * @option string "id"
     * @throws \Exception
     */
    public function add(string $type, array $params): AbstractResult
    {
        return $this->master->call('files/add', $params);
    }
    
    /**
     * List of files
     *
     * @param string $type - mms|voice
     *
     * @return AbstractResult
     * @option array "items"
     * @option string "id"
     * @option string "name"
     * @option int "size"
     * @option string "type" - mms|voice
     * @option string "date"
     * @throws \Exception
     */
    public function index(string $type): AbstractResult
    {
        $params = ['type' => $type];
        
        return $this->master->call('files/index', $params);
    }
    
    /**
     * View file
     *
     * @param string $id
     * @param string $type - mms|voice
     *
     * @return AbstractResult
     * @option string "id"
     * @option string "name"
     * @option int "size"
     * @option string "type" - mms|voice
     * @option string "date"
     * @throws \Exception
     */
    public function view(string $id, string $type): AbstractResult
    {
        $params = ['id' => $id, 'type' => $type];
        
        return $this->master->call('files/view', $params);
    }
    
    /**
     * Deleting a file
     *
     * @param string $id
     * @param string $type - mms|voice
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function delete(string $id, string $type): AbstractResult
    {
        $params = ['id' => $id, 'type' => $type];
        
        return $this->master->call('files/delete', $params);
    }
    
}
