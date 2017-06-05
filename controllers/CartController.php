<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use yii\data\ActiveDataProvider;
use app\models\Cart;
use yii\web\HttpException;

class CartController extends _BaseController {

    public $session;
    public $enableCsrfValidation = false;

    public function __construct($id, $module, $config = []) {
        $this->session = Yii::$app->session['cart'];
        parent::__construct($id, $module, $config);
    }

    public function actionPageShoppingCart() {
        //Ищем все товары, необходимые для формирования корзины
        //Кладем их в массив $products_arr 
        //затем передаем этот массив на страницу корзины
        $arrprice = Cart::recalcpricearr($this->session); //Функция пересчета Итоговой суммы
        //$totalprice_all = $arrprice['totalprice_all'];
        $products_arr = Cart::allcartitems();
        if ($products_arr) {
            $dataProvider = new ActiveDataProvider([
                'query' => Product::find()->andWhere(['in', 'id', $products_arr])->andWhere(['visibility' => 1])->orderBy(['updated' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 12,
                ],
            ]);

            return $this->render('page-shopping-cart', ['dataProvider' => $dataProvider, 'arrprice' => $arrprice]);
        }
        throw new HttpException(null, 'В корзине отсутствуют товары');
    }

    //Добавление товара в корзину - Один из вариантов реализации - сейчас не используем
    //Данный метод сейчас вызывается через Ajax запрос  - см base.js - $('[data-toggle = modal]')
    //Сейчас использ вариант с _modal_form - добавление товара в сессию в app\model\CartItem
    public function actionAddProductToCart($product_id) {
        //$product_id = Yii::$app->request->post('product_id');
        $model = Product::findOne($product_id);
        return 'Добавление в корзину товара ' . $model->title;
        //@TODO Реализовать добавление товара в сессию
    }

    //Данный метод сейчас вызывается через Ajax запрос - см base.js - $('.remove-cart-item')
    //$product_id передаем через GET 
    public function actionAjaxRemoveCartItem($product_id) {
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
        //Пересчет Итоговой суммы происходит ajax запросом в base.js

        return 'Удаление товара из корзины id=' . $product_id;
    }

    public function actionAjaxUpdateCartItemCount() {
        //Если параметры передавать через POST
        //1 - Получаем параметры переданные через Ajax
        $product_id = Yii::$app->request->post('product_id');
        $product_count = Yii::$app->request->post('product_count');
        $this->session[$product_id]['count'] = $product_count;
        Yii::$app->session['cart'] = $this->session;
        //Пересчет Итоговой суммы происходит ajax запросом в base.js
    }

    public function actionAjaxRecalcTotalPrice() {
        $arrprice = Cart::recalcpricearr($this->session); //Функция пересчета Итоговой суммы
        $totalprice_all = $arrprice['totalprice_all'];
        return $totalprice_all;
    }

    //Добавление товара по кнопке '+' и пересчет Итоговой суммы
    public function actionCartItemPlus($product_id) {
        
    }

    //Удаление товара по кнопке '-' и пересчет Итоговой суммы 
    public function actionCartItemMinus($product_id) {
        
    }

}
