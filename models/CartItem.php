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

    //В сессии в массиве Cart удаляем массив по продукту - удаляем товар из корзины
    public function remove($id) {
        
    }

    //Метод поиска товара в корзине (session['cart']) по id товара
    public static function findOne($id) {
        //@TODO Реализовать метод поиска товара в сессии
        
        //Если в сессиии нет -  return new self(['id'=>$id])
        return new self(['id' => $id]);
    }

}
