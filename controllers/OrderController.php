<?php

namespace app\controllers;

use Yii;
use app\models\Cart;
use app\models\Order;

class OrderController extends _BaseController {

    //Создание заказа и запись его в базу на основании массива $_SESSION
    public function actionCreateOrder($id = null) {
        $order = $id ? Order::findOne($id) : new Order();

        if ($arrprice = Cart::recalcpricearr(Yii::$app->session['cart'])) {
            return $this->render('order', [
                'arrprice' => $arrprice, 'model' => $order]);
        }
    }

}
