<?php

namespace app\models;

use Yii;
use yii\web\Session;

class CartItem extends \yii\base\Model {

    public $id; //ID товара в корзине - Артикул
    public $count; //Количество товара в корзине

    public function rules() {
        return [
                [['id', 'count'], 'required'],
                [['id', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'count' => 'Количество',
        ];
    }

    //В сессии в массив Cart записываем массив по продукту - добавляем товар в корзину
    public function save() {
        $session = Yii::$app->session;
        $product_id = $this->id;
        $cart = $session['cart'];
        $cart['lifetime'] = 2000;
        $cart[$product_id] = ['count' => $this->count,];
        $session['cart'] = $cart;

        return true;
    }

    //Метод поиска товара в корзине (session['cart']) по id товара
    public static function findOne($product_id) {
        $cart_item = Yii::$app->session['cart'][$product_id];

        If ($cart_item) {
            return new self(['id' => $product_id,'count' => $cart_item['count']]);
        }

        //Если в сессиии нет искомого продукта - return new self(['id'=>$id])
        return new self(['id' => $product_id]);
    }

}
