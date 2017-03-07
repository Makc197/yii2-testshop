<?php
namespace app\controllers;

class ShopController extends _BaseController{

    public function actionPageShoppingCart() {
        return $this->render('page-shopping-cart');
    }

}
