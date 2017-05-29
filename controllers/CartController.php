<?php

namespace app\controllers;

use Yii;

class CartController extends _BaseController {

    public $session;

    public function __construct($id, $module, $config = []) {
        $this->session = Yii::$app->session['cart'];
        parent::__construct($id, $module, $config);
    }

    //Данный метод сейчас вызывается через Ajax запрос - см base.js - $('.remove-cart-item')
    //$product_id передаем через GET 
    public function actionRemoveCartItem($product_id) {
        //Если параметры передавать через POST
        //$product_id = Yii::$app->request->post('$product_id'); 

        if ($session) {
            //$arrkeys = array_keys($session);

            $callback = function($key) use ($product_id) {
                return $key != $product_id;
            };

            $session = array_filter($session, $callback, ARRAY_FILTER_USE_KEY);
        }

        Yii::$app->session['cart'] = $session;
        //Пересчет Итоговой суммы
        $this->actionCartTotalPrice();
        
        return 'Удаление товара из корзины id=' . $product_id;
    }

    //Добавление товара по кнопке '+' и пересчет Итоговой суммы
    public function actionCartItemPlus($product_id) {
        
    }

    //Удаление товара по кнопке '-' и пересчет Итоговой суммы 
    public function actionCartItemMinus($product_id) {
        
    }

    //Функция пересчета Итоговой суммы
    public function actionCartTotalPrice() {
        
    }

}
