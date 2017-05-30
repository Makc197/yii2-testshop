<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Cart;

class CartController extends _BaseController {

    public $session;
    public $enableCsrfValidation = false;

    public function __construct($id, $module, $config = []) {
        $this->session = Yii::$app->session['cart'];
        parent::__construct($id, $module, $config);
    }

    //Данный метод сейчас вызывается через Ajax запрос - см base.js - $('.remove-cart-item')
    //$product_id передаем через GET 
    public function actionRemoveCartItem($product_id) {
        //Если параметры передавать через POST
        //$product_id = Yii::$app->request->post('$product_id'); 

        if ($this->session) {
            //$arrkeys = array_keys($session);

            $callback = function($key) use ($product_id) {
                return $key != $product_id;
            };

            $this->session = array_filter($this->session, $callback, ARRAY_FILTER_USE_KEY);
        }

        Yii::$app->session['cart'] = $this->session;

        //Пересчет Итоговой суммы
        $this->actionRecalcTotalPrice();

        return 'Удаление товара из корзины id=' . $product_id;
    }

    public function actionUpdateCartItemCount() {
        //Если параметры передавать через POST
        //1 - Получаем параметры переданные через Ajax
        $product_id = Yii::$app->request->post('product_id');
        $product_count = Yii::$app->request->post('product_count');
        $this->session[$product_id]['count'] = $product_count;
        Yii::$app->session['cart'] = $this->session;

        //Пересчет Итоговой суммы происходит ajax запросом в base.js
        //$this->actionRecalcTotalPrice();
    }

    //Добавление товара по кнопке '+' и пересчет Итоговой суммы
    public function actionCartItemPlus($product_id) {
        
    }

    //Удаление товара по кнопке '-' и пересчет Итоговой суммы 
    public function actionCartItemMinus($product_id) {
        
    }

    //Функция пересчета Итоговой суммы
    public function actionRecalcTotalPrice() {
//     @TODO реализовать пересчет итоговой суммы перебором массива $this->session
//По $product_id ищем продукт и берем его цену  
        $products_arr = Cart::allcartitems();
        var_dump($products_arr);
        foreach ($products_arr as $key => $product_id) {
            $product_count = $this->session[$product_id]['count'];

            if (($productmodel = Product::findOne($product_id)) !== null) {
                $productprice = $productmodel->price;
            }

            print $product_id . ' - ' . $product_count . ' - ' . $productprice . '\n';
        }
//        return 150;
    }

}
