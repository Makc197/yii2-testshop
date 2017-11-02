<?php

namespace app\modules\root\controllers;

use Yii;
use app\Models\Order;
use app\models\OrderProduct;
use app\Models\OrderSearch;
//use app\models\Product;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
//use yii\filters\VerbFilter;
//use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;

/**
 * OrderController implements the CRUD actions for Order model.
 */
class OrderController extends Controller {

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

    public function actionIndex() {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
//        $dataProvider = new ActiveDataProvider([
//            'query' => Order::find()->where(['id' => $id])->one()->getProducts(),
//            'pagination' => [
//                'pageSize' => 5,
//            ],
//        ]);

        $products_arr = Order::find()->where(['id' => $id])->one()->products;
//      Формируем массив и передаем его в качестве \yii\data\ArrayDataProvider в \yii\grid\GridView
        foreach ($products_arr as $product) {
            $product_id = $product['id'];
            $order_product = OrderProduct::find()->where(['order_id' => $id, 'product_id' => $product_id])->one();
            $product_count = $order_product['count'];
            $productprice = $order_product['price'];
            $arrprice['cart'][$product_id]['count'] = $product_count;
            $arrprice['cart'][$product_id]['price'] = $productprice;
            $arrprice['cart'][$product_id]['title'] = $product['title'];
            $arrprice['cart'][$product_id]['article'] = str_pad($product_id, 8, "0", STR_PAD_LEFT);
            $totalprice_product = $productprice * $product_count;
            $arrprice['cart'][$product_id]['totalprice_product'] = $totalprice_product;
            $totalprice_all = $totalprice_all + $totalprice_product;
        }

//      $arrprice['totalprice_all'] = $totalprice_all;

        $dataProvider = new ArrayDataProvider([
            'allModels' => $arrprice['cart'],
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id), 'dataProvider' => $dataProvider, 'totalprice_all' => $totalprice_all
        ]);
    }

    /**
     * Creates a new Order model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Order();

        if ($model->load(Yii::$app->request->post()) && $model->adminOrder() && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        //Определение сценария
        //$model->orderScenario();
        //echo $model->getScenario(); die;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
