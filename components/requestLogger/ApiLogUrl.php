<?php

namespace app\components\requestLogger;

use app\components\jsonrpc\ApiService;

class ApiLogUrl extends ApiService
{
    public $method = "api1.logger.save-log";

    public function send()
    {
        return $this->query();
    }
}