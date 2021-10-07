<?php

namespace app\components\activity;

use yii\base\Behavior;
use yii\base\Component;
use yii\db\ActiveRecord;

class UrlEventHandler
{
    public $url;
    public $datetime;
    public $urlLoggerService;

    public function __construct()
    {
        $this->url = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $this->datetime = time();
        $this->urlLoggerService =new UrlLoggerService();
    }

    public function sendData()
    {
        $this->urlLoggerService->setMethod("api1.logger.save-log");
        $this->urlLoggerService->setParams(['url' => $this->url, 'datetime' => $this->datetime]);
        
        return $this->urlLoggerService->query();
    }

    static public function sendLog()
    {
        $handler = new self();
        return $handler->sendData();
    }
}