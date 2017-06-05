<?php

namespace app\models;

use Yii;
use app\models\Product;

//Модель Корзины  
//работаем с корзиной посредством массива $_SESSION 
//добавление записи о товаре в сессию происходит в CartItem
class Cart extends \yii\base\Model {

    //Функция allcartitems возвращает массив товаров из корзины
    public static function allcartitems() {
        if (Yii::$app->session['cart']) {
            $products_arr = array_keys(Yii::$app->session['cart']);

            $callback = function($item) {
                return $item != 'lifetime';
            };

            $products_arr = array_filter($products_arr, $callback);
            return $products_arr;
        }

        return false;
    }

//Функция recalcpricearr возвращает 
//массив итоговых цен по каждой позиции и
//итоговую суммы корзины  
    public static function recalcpricearr($session) {
 
        if ($products_arr = self::allcartitems()) {
            //перебор массива $products_arr
            //По $product_id ищем продукт и берем его цену
            foreach ($products_arr as $key => $product_id) {
                $product_count = $session[$product_id]['count'];

                if (($productmodel = Product::findOne($product_id)) !== null) {
                    $productprice = $productmodel->price;
                }

                $totalprice_product = $productprice * $product_count;
                $arrprice[$product_id] = $totalprice_product;
                $totalprice_all = $totalprice_all + $totalprice_product;
            }
            $arrprice['totalprice_all'] = $totalprice_all;
            return $arrprice;
        }

        return false;
    }

}
