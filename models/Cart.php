<?php

namespace app\models;

USE Yii;
//use app\components\MyException;
use yii\web\HttpException;

class Cart extends \yii\base\Model {

    //Модель Корзины  
    //аботаем с корзиной посредством массива $_SESSION 
    //добавление записи о товаре в сессию происходит в CartItem
    //
    //Функция возвращающая массив товаров из корзины
    public static function allcartitems() {
        $products_arr = array_keys(Yii::$app->session['cart']);
        $callback = function($item) {
            return $item != 'lifetime';
        };
        $products_arr = array_filter($products_arr, $callback);

        if ($products_arr) {
            return $products_arr;
        } else {
//            throw new MyException(null,'В корзине отсутствуют товары');
            throw new HttpException(null, 'В корзине отсутствуют товары');
        }
    }

}
