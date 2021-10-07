<?php

namespace app\controllers;

use app\components\activity\UrlLoggerService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;

class AdminController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            /*
             * Раскомментировать когда появится метод авторизации
             */
            // 'access' => [
            //     'class' => AccessControl::className(),
            //     'only' => ['activity'],
            //     'rules' => [
            //         [
            //             'actions' => ['activity'],
            //             'allow' => true,
            //             'roles' => ['@'],
            //         ],
            //     ],
            // ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'activity' => ['get'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionActivity()
    {
        $urlLogService = new UrlLoggerService();
        $dataProvider = $urlLogService->getDataProvider();

        return $this->render('activity', [
            'dataProvider' => $dataProvider['models'],
            'pages' => $dataProvider['pages'],
        ]);
    }
}
