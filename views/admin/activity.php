<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\widgets\LinkPager;

$this->title = 'My Yii Application';
?>

<div class="admin-activity">
    <div class="jumbotron text-center bg-transparent">
        <h1>activity!</h1>
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}",
            'columns' => [
                'url',
                'count',
                'lastVisit'
            ],
        ]); ?>

        <?= LinkPager::widget([
            'pagination' => $pages,
        ]); ?>
    </div>
</div>