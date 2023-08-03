<?php

namespace betterapp\LaravelServerSms\Services;

use betterapp\LaravelServerSms\Results\AbstractResult;

class Payments extends AbstractCommon
{
    /**
     * List of payments
     *
     * @return AbstractResult
     * @option array "items"
     * @option int "id"
     * @option string "number"
     * @option string "state" paid|not_paid
     * @option float "paid"
     * @option float "total"
     * @option string "payment_to"
     * @option string "url"
     * @throws \Exception
     */
    public function index(): AbstractResult
    {
        return $this->master->call('payments/index');
    }
    
    /**
     * View single payment
     *
     * @param int $id
     *
     * @return AbstractResult
     * @option int "id"
     * @option string "number"
     * @option string "state" paid|not_paid
     * @option float "paid"
     * @option float "total"
     * @option string "payment_to"
     * @option string "url"
     * @throws \Exception
     */
    public function view(int $id): AbstractResult
    {
        $params = ['id' => $id];
        
        return $this->master->call('payments/view', $params);
    }
    
    /**
     * Download invoice as PDF
     *
     * @param int $id
     *
     * @return resource
     * @throws \Exception
     */
    public function invoice(int $id): AbstractResult
    {
        $params = ['id' => $id];
        
        return $this->master->call('payments/invoice', $params);
    }
    
}
