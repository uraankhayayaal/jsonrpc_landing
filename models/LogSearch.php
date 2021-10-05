<?php 

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

class LogSearch extends Log
{
    public function rules()
    {
        return [
            [['url', 'datetime'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Log::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}