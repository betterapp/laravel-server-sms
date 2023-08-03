<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Premium extends AbstractCommon
{
    /**
     * List of received SMS Premium
     *
     * @return AbstractResult
     * @option array "items"
     * @option int "id"
     * @option string "to_number" Premium number
     * @option string "from_number" Sender phone number
     * @option string "date"
     * @option int "limit" Limitation the number of responses
     * @option string "text" Message
     * @throws \Exception
     */
    public function index(): AbstractResult
    {
        return $this->master->call('premium/index');
    }
    
    /**
     * Sending replies for received SMS Premium
     *
     * @param string $phone
     * @param string $text Message
     * @param string $gate Premium number
     * @param int    $id   ID received SMS Premium
     *
     * @return AbstractResult
     * @option bool "success"
     * @throws \Exception
     */
    public function send(string $phone, string $text, string $gate, int $id): AbstractResult
    {
        $params = ['phone' => $phone, 'text' => $text, 'gate' => $gate, 'id' => $id];
        
        return $this->master->call('premium/send', $params);
    }
    
    /**
     * View quiz results
     *
     * @param int $id
     *
     * @return AbstractResult
     * @option int "id"
     * @option string "name"
     * @option array "items"
     * @option int "id"
     * @option int "count" Number of response
     * @throws \Exception
     */
    public function quiz(int $id): AbstractResult
    {
        return $this->master->call('quiz/view', ['id' => $id]);
    }
}
