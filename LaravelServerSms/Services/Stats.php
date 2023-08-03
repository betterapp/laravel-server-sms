<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Stats extends AbstractCommon
{
    /**
     * Statistics an sending
     *
     * @param array $params
     *
     * @option string "type" eco|full|voice|mms
     * @option string "begin" Start date
     * @option string "end" End date
     * @return AbstractResult
     * @option array "items"
     * @option int "id"
     * @option string "name"
     * @option int "delivered"
     * @option int "pending"
     * @option int "undelivered"
     * @option int "unsent"
     * @option string "begin"
     * @option string "end"
     * @option string "text"
     * @option string "type" eco|full|voice|mms
     * @throws \Exception
     */
    public function index(array $params = []): AbstractResult
    {
        return $this->master->call('stats/index', $params);
    }
}
