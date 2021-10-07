<?php

namespace app\components\activity;

use app\components\jsonrpc\ApiService;
use yii\data\ArrayDataProvider;
use yii\data\Pagination;

class UrlLoggerService extends ApiService
{
    const PAGE_SIZE = 20;

    public function getDataProvider()
    {
        $this->setMethod("api1.logger.show-logs");
        $this->setParams(['limit' => self::PAGE_SIZE, 'offset' => (\Yii::$app->request->get('page', 1) * self::PAGE_SIZE - self::PAGE_SIZE)]);

        $data = $this->query();

        $models = $data['result']['models'];
        $totalCount = $data['result']['totalCount'];

        $pages = new Pagination(['totalCount' => $totalCount, 'defaultPageSize' => self::PAGE_SIZE]);

        $dataProvider = new ArrayDataProvider([
            'allModels' => $models,
        ]);
        
        return ['models' => $dataProvider, 'pages' => $pages];
    }
}