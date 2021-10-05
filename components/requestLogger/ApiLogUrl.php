<?php

namespace app\components\requestLogger;

use app\components\jsonrpc\ApiService;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;

class ApiLogUrl extends ApiService
{
    const PAGE_SIZE = 20;
    public function send()
    {
        $this->setMethod("api1.logger.save-log");
        return $this->query();
    }

    public function getDataProvider()
    {
        $this->setMethod("api1.logger.show-logs");
        $this->setParams(['limit' => self::PAGE_SIZE, 'offset' => (\Yii::$app->request->get('page', 1) * self::PAGE_SIZE - self::PAGE_SIZE)]);

        $models =       $this->query()['result']['models'];
        $totalCount =   $this->query()['result']['totalCount'];

        $pages = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => self::PAGE_SIZE]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $models,
        ]);
        
        return ['models' => $dataProvider, 'pages' => $pages];
    }
}