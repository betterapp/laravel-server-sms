<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Error extends AbstractCommon
{
    /**
     * Preview error
     *
     * @param int $code
     *
     * @return AbstractResult
     * @option int "code"
     * @option string "type"
     * @option string "message"
     * @throws \Exception
     */
    public function view(int $code): AbstractResult
    {
        return $this->master->call('error/' . $code);
    }
}
