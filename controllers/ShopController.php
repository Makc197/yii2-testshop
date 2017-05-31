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

}
