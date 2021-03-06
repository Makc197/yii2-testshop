<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Order;
use yii\data\ArrayDataProvider;
use yii\widgets\ActiveForm;
use yii\web\Response;

class OrderController extends _BaseController {

    public $enableCsrfValidation = false;

    //Создание заказа и запись его в базу на основании массива $_SESSION
    public function actionCreateOrder($id = null) {

        $order = $id ? Order::findOne($id) : new Order();

        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $order->selectOrderingScenario();
            return ActiveForm::validate($order);
        }


        //Массив товаров в корзине
        $arrprice = Cart::recalcpricearr(Yii::$app->session['cart']);

        if (Yii::$app->request->isPost) {
            //Если создается новый заказ и в корзине присутствуют товары -
            //загрузка массива $_POST, валидация, сохранение, редирект на главную
            if ($id == null && $arrprice && $order->createNewOrder($arrprice)) {
                //Очищение корзины при успешном оформлении заказа
                Yii::$app->session->remove('cart');
                return $this->redirect('/');
            }
        }

        //Рендер страницы оформления заказа если в корзине присутствуют товары
        if ($arrprice) {
            $dataProvider = new ArrayDataProvider([
                'allModels' => $arrprice['cart'],
                'pagination' => [
                    'pageSize' => 5,
                ],
            ]);

            return $this->render('order', [
                'arrprice' => $arrprice, 'model' => $order, 'dataProvider' => $dataProvider]);
        }
    }

}
