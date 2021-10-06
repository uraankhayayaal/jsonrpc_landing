<?php

namespace app\components\jsonrpc;

use yii\httpclient\Client;

abstract class ApiService {

    const JSON_RPC_VERSION = "2.0";
    const JSON_RPC_ENDPOINT = 'http://activity.kazandev.u0258205.cp.regruhosting.ru/index.php?r=json-rpc/index';

    public $method = null;
    public $params = null;

    public function send()
    {
        return $this->query();
    }

    public function wrapData()
    {
        $data = [
            "jsonrpc" => self::JSON_RPC_VERSION,
            "method" => $this->method,
            "id" => 1
        ];
        if($this->params !== null){
            $data["params"] = $this->params;
        }
        return $data;
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

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
    }
}