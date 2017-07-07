<?php

namespace app\modules\root\controllers;

use Yii;
use app\Models\Order;
use app\models\OrderProduct;
use app\Models\OrderSearch;
use app\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class StatisticController extends Controller {

    public $enableCsrfValidation = false;

//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    public function actionProductsSell() {

        $test = OrderProduct::find()
        ->joinWith('product', 'product.categories')
        ->select(['category.name', 'COUNT(*) as cent'])
        ->groupBy(['category.name'])
        ->all();

        var_dump($test);
        exit;

        $dataProvider = new ActiveDataProvider([
//        'query' => OrderProduct::
        ]);

        return $this->render('productssell', [
            'dataProvider' => $dataProvider
        ]);
    }

}
