<?php

namespace app\components\jsonrpc;

use Yii;
use yii\httpclient\Client;

abstract class ApiService {

    const JSON_RPC_VERSION = "2.0";

    public $method = null;
    public $params = null;

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
            ->setUrl(Yii::$app->params['jsonrpcUrl'])
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