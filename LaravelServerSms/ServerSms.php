<?php

namespace betterapp\LaravelServerSms;

use betterapp\LaravelServerSms\Results\AbstractResult;
use betterapp\LaravelServerSms\Results\SimpleXmlResult;
use betterapp\LaravelServerSms\Results\StdClassResult;
use betterapp\LaravelServerSms\Services\Account;
use betterapp\LaravelServerSms\Services\Blacklist;
use betterapp\LaravelServerSms\Services\Contacts;
use betterapp\LaravelServerSms\Services\Error;
use betterapp\LaravelServerSms\Services\Files;
use betterapp\LaravelServerSms\Services\Groups;
use betterapp\LaravelServerSms\Services\Messages;
use betterapp\LaravelServerSms\Services\Payments;
use betterapp\LaravelServerSms\Services\Phones;
use betterapp\LaravelServerSms\Services\Premium;
use betterapp\LaravelServerSms\Services\Senders;
use betterapp\LaravelServerSms\Services\Stats;
use betterapp\LaravelServerSms\Services\SubAccounts;
use betterapp\LaravelServerSms\Services\Templates;

class ServerSms
{
    public \StdClass $config;
    
    // Access to API
    public string $apiUrl = 'https://api2.serwersms.pl/';
    public string $format = 'json';
    public string $username;
    public string $password;
    public ?string $sender = null;
    
    // Services
    public Messages $messages;
    public Files $files;
    public Premium $premium;
    public Account $account;
    public Senders $senders;
    public Groups $groups;
    public Contacts $contacts;
    public Phones $phones;
    public SubAccounts $subAccounts;
    public Blacklist $blacklist;
    public Payments $payments;
    public Stats $stats;
    public Templates $templates;
    public Error $error;
    
    /**
     * @param ?string $apiUrl
     * @param ?string $format
     * @param ?string $username
     * @param ?string $password
     * @param ?string $sender
     *
     * @throws \Exception
     */
    public function __construct(?string $apiUrl = null, ?string $format = null, ?string $username = null, ?string $password = null, ?string $sender = null)
    {
        $this->setConfig($apiUrl, $format, $username, $password, $sender);
        
        $this->messages = new Messages($this);
        $this->files = new Files($this);
        $this->premium = new Premium($this);
        $this->account = new Account($this);
        $this->senders = new Senders($this);
        $this->groups = new Groups($this);
        $this->contacts = new Contacts($this);
        $this->phones = new Phones($this);
        $this->subAccounts = new SubAccounts($this);
        $this->blacklist = new Blacklist($this);
        $this->payments = new Payments($this);
        $this->stats = new Stats($this);
        $this->templates = new Templates($this);
        $this->error = new Error($this);
    }
    
    /**
     * @param string $url
     * @param array  $params
     *
     * @return AbstractResult
     * @throws \Exception
     */
    public function call(string $url, array $params = []): AbstractResult
    {
        $params['username'] = $this->username;
        $params['password'] = $this->password;
        
        $curl = curl_init($this->apiUrl . $url . '.' . $this->format);
        
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        $answer = curl_exec($curl);
        
        if (curl_errno($curl)) {
            throw new Exception('Failed call: ' . curl_error($curl) . ' ' . curl_errno($curl));
        }
        curl_close($curl);
        
        if ($this->format == 'xml') {
            $result = (new SimpleXmlResult())->setResult(simplexml_load_string($answer));
            
            if (isset($result->code) and isset($result->type) and isset($result->message)) {
                throw new Exception($result->message, (int)$result->code);
            }
        } else {
            $result = (new StdClassResult())->setResult(json_decode($answer));
            
            if (isset($result->error)) {
                throw new Exception($result->error->message, (int)$result->error->code);
            }
        }
        
        return $result;
    }
    
    /**
     * @param ?string $apiUrl
     * @param ?string $format
     * @param ?string $username
     * @param ?string $password
     * @param ?string $sender
     *
     * @return void
     * @throws \Exception
     */
    private function setConfig(?string $apiUrl, ?string $format, ?string $username, ?string $password, ?string $sender = null): void
    {
        $config = \Config::get('server-sms');
        if (isset($config)) {
            $this->config = json_decode(json_encode($config), FALSE);
        }
        
        if (is_null($apiUrl) && isset($config['api_url'])) {
            $apiUrl = $this->config->api_url;
        }
        if (is_null($format) && isset($config['format'])) {
            $format = $this->config->format;
        }
        if (is_null($username) && isset($config['username'])) {
            $username = $this->config->username;
        }
        if (is_null($password) && isset($config['password'])) {
            $password = $this->config->password;
        }
        if (is_null($sender) && isset($config['sender'])) {
            $sender = $this->config->sender;
        }
        
        if (!$apiUrl) {
            throw new \Exception('ApiUrl is empty');
        }
        if (!$format) {
            throw new \Exception('Format is empty');
        }
        if (!$username) {
            throw new \Exception('Username is empty');
        }
        if (!$password) {
            throw new \Exception('Password is empty');
        }
        
        $this->username = $username;
        $this->password = $password;
        $this->apiUrl = $apiUrl;
        $this->format = $format;
        $this->sender = $sender;
    }
}
