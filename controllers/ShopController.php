<?php

namespace app\controllers;

use app\models\Product;
use app\models\ProductSearch;
use app\models\Image;
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

    public function actionPageProductDetails($id) {
        //1 - Product model
        $model = $this->findProductModel($id);

        //2 - ImageModel
//        $imgmodel = $this->findImgModel($imgid);
//        $imgfilename = $imgmodel->img;


        return $this->render('page-product-details', [
            'model' => $model
        ]);
    }

    public function actionPageShoppingCart() {
        return $this->render('page-shopping-cart');
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findProductModel($id) {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findImgModel($imgid) {
        if (($imgmodel = Image::findOne($imgid)) !== null) {
            return $imgmodel;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
