<?php

namespace app\modules\root\controllers;

use \yii\db\Query;
use yii\web\Controller;
//use yii\filters\VerbFilter;

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
        $productsbycategory = (new Query())
        ->from('order_product')
        ->leftJoin('product', 'order_product.product_id = product.id')
        ->innerJoin('mm_category_product', 'mm_category_product.product_id = product.id')
        ->leftJoin('category', 'mm_category_product.category_id = category.id')
        ->groupBy(['category.name'])
        ->select(['sum(order_product.count) as count', 'category.name'])
        ->all();

        $productsbycategory2 = array_column($productsbycategory, 'count');
        $category = array_column($productsbycategory, 'name');

        return $this->render('productssell', [
            'productsbycategory' => $productsbycategory2,
            'category' => $category
        ]);
    }

    public function actionCostByCategory() {
        $productsbycategory = (new Query())
        ->from('order_product')
        ->leftJoin('product', 'order_product.product_id = product.id')
        ->innerJoin('mm_category_product', 'mm_category_product.product_id = product.id')
        ->leftJoin('category', 'mm_category_product.category_id = category.id')
        ->groupBy(['category.name'])
        ->select(['category.name', 'sum(order_product.price*order_product.count) as summ'])
        ->all();        
       
        $productsbycategory2 = array_column($productsbycategory, 'summ');
        $category = array_column($productsbycategory, 'name');

        return $this->render('costbycategory', [
            'productsbycategory' => $productsbycategory2,
            'category' => $category
        ]);
    }

}
