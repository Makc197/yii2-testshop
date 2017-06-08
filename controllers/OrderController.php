<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Order;
use yii\data\ArrayDataProvider;

class OrderController extends _BaseController {

    //Создание заказа и запись его в базу на основании массива $_SESSION
    public function actionCreateOrder($id = null) {
        $order = $id ? Order::findOne($id) : new Order();

        //Если создается новый заказ - загрузка массива $_POST, валидация, сохранение, редирект на главную
        if ($order->createNewOrder()) {
            Yii::$app->session->remove('cart');
            return $this->redirect('/');
        }

        //Рендер страницы оформления заказа если в корзине присутствуют товары
        if ($arrprice = Cart::recalcpricearr(Yii::$app->session['cart'])) {
            $dataProvider = new ArrayDataProvider([
                'allModels' => $arrprice['cart'],
                'pagination' => [
                    'pageSize' => 3,
                ],
            ]);

            return $this->render('order', [
                'arrprice' => $arrprice, 'model' => $order, 'dataProvider' => $dataProvider]);
        }
    }

}
