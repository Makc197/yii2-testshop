<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class ShopController extends _BaseController {

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

    public function actionPageProductsTmpl() {
        return $this->render('page-products-tmpl');
    }

    public function actionPageProductDetails() {
        return $this->render('page-product-details');
    }

    public function actionPageShoppingCart() {
        return $this->render('page-shopping-cart');
    }

}
