<?php

namespace app\components\jsonrpc;

use yii\httpclient\Client;

abstract class ApiService {

    const JSON_RPC_VERSION = "2.0";
    const JSON_RPC_ENDPOINT = 'http://activity.loc/json-rpc';

    public $method;
    public $params;

    public function send()
    {
        return $this->query();
    }

    public function wrapData()
    {
        return [
            "jsonrpc" => self::JSON_RPC_VERSION,
            "method" => $this->method,
            "params" => $this->params,
            "id" => 1
        ];
    }
    
    public function query()
    {
        $data = $this->wrapData();

        $client = new Client();
        $response = $client->createRequest()
            ->setFormat(Client::FORMAT_JSON)
            ->setMethod('POST')
            ->setUrl(self::JSON_RPC_ENDPOINT)
            ->setData($data)
            ->send();
        if ($response->isOk) {
            $newUserId = $response->data;
        }

        return $response->data;
    }

    public function setMethod(array $method)
    {
        $this->method = $method;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }
}