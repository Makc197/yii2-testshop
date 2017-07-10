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
class StatisticsController extends Controller {

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
        $test = (new \yii\db\Query())
        ->from('order_product')
        ->leftJoin('product', 'order_product.product_id = product.id')
        ->innerJoin('mm_category_product', 'mm_category_product.product_id = product.id')
        ->leftJoin('category', 'mm_category_product.category_id = category.id')
        ->groupBy(['category.name'])
        ->select(['count(*)', 'category.name'])
        ->all();

//        $test = OrderProduct::find()
//        ->joinWith('product')
//        ->with('category')
//        //->with('product')
//       //->leftJoin('order', 'order.id = order_product.order_id')
//        //->Where(['category_id' => 'product.id'])
//        //->select(['category.name', 'COUNT(*) as cnt'])
//        //->groupBy(['category.name'])
//        ->all();

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
