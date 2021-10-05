<?php 

namespace app\models;

use yii\base\Model;

class Log extends Model
{
    public $url;
    public $count;
    public $lastVisit;

    public function rules()
    {
        return [
            [['url', 'datetime'], 'required'],
            [['url', 'datetime'], 'string'],
        ];
    }
}