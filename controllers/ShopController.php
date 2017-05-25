<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ShopController extends _Modal {

    public static $model_name = 'app\models\CartItem';

//  public $enableCsrfValidation = false;

    public function actionPageProducts($category_id) {
        if (!$category = Category::findOne($category_id)) {
            throw new NotFoundHttpException('Category does not exist.');
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->joinWith('mmCategoryProducts')->andWhere(['category_id' => $category_id])->andWhere(['visibility' => 1])->orderBy(['updated' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('page-products', ['category' => $category, 'dataProvider' => $dataProvider]);
    }

    public function actionPageProductDetails($product_id) {
        $model = $this->findProductModel($product_id);

        return $this->render('page-product-details', [
            'model' => $model
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($product_id) {
        if (($model = Product::findOne($product_id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPageShoppingCart() {
        //Ищем все товары, необходимые для формирования корзины
        //Кладем их в массив $products_arr 
        //затем передаем этот массив на страницу корзины
        $products_arr = [];
        if (Yii::$app->session['cart']) {
            $products_arr = array_keys(Yii::$app->session['cart']);
            $callback = function($item) {
                return $item != 'lifetime';
            };
            $products_arr = array_filter($products_arr, $callback);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Product::find()->joinWith('mmCategoryProducts')->andWhere(['in', 'id', $products_arr])->andWhere(['visibility' => 1])->orderBy(['updated' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 12,
            ],
        ]);

        return $this->render('page-shopping-cart', ['dataProvider' => $dataProvider]);
    }

    //Добавление товара в корзину - Один из вариантов реализации - сейчас не используем
    //Данный метод сейчас вызывается через Ajax запрос  - см base.js - $('[data-toggle = modal]')
    //Сейчас использ вариант с _modal_form - добавление товара в сессию в app\model\CartItem
    public function actionAddProductToCart($product_id) {
        //$product_id = Yii::$app->request->post('product_id');
        $model = $this->findProductModel($product_id);
        return 'Добавление в корзину товара ' . $model->title;
        //@TODO Реализовать добавление товара в сессию
    }

    //Данный метод сейчас вызывается через Ajax запрос - см base.js - $('.remove-cart-item')
    //$product_id передаем через GET 
    public function actionRemoveCartItem($product_id) {
        //Если параметры передавать через POST
        //$product_id = Yii::$app->request->post('$product_id'); 
        $model = $this->findProductModel($product_id);
        //@TODO Реализовать удаление товара из сессии

        echo $product_id;

        $session = Yii::$app->session['cart'];

        var_dump($session);
        echo('=======================');

        if ($session) {
            $arrkeys = array_keys($session);
            
            $callback = function($val, $key) {
                echo ' |  ';
                echo $product_id; //Не видна здесь ????
                echo '   ';
                echo $key;
                echo '   ';
                echo $key != $product_id;

                return $key != $product_id;
            };

            $session = array_filter($session, $callback, ARRAY_FILTER_USE_BOTH);
        }

        var_dump($session);

        Yii::$app->session['cart'] = $session;

        return 'Удаление товара из корзины: ' . $model->title;
    }

}
