<?php

namespace app\components\requestLogger;

use yii\base\Behavior;
use yii\base\Component;
use yii\db\ActiveRecord;

class EventHandlerComponent
{
    public $url;
    public $datetime;
    public $apiLoggerData;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->datetime = time();
        $this->apiLoggerData =new ApiLogUrl();
    }

    public function sendData()
    {
        $this->apiLoggerData->setParams(['url' => $this->url, 'datetime' => $this->datetime]);
        return $this->apiLoggerData->send();
    }

    static public function sendLog()
    {
        $handler = new self();
        return $handler->sendData();
    }
}