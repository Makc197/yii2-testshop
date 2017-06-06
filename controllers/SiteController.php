<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\ContactForm;

class SiteController extends _BaseController {

    public function actionIndex() {
        //var_dump(Yii::$app->user->identity->fBirthday); die;
        return $this->render('index');
    }

    public function actionPageProducts() {
        return $this->render('page-products');
    }

    public function actionPageProductDetails() {
        return $this->render('page-product-details');
    }

    public function actionPagePortfolioItem() {
        return $this->render('page-portfolio-item');
    }

    public function actionPagePortfolio2Columns1() {
        return $this->render('page-portfolio-2-columns-1');
    }

    public function actionPagePortfolio2Columns2() {
        return $this->render('page-portfolio-2-columns-2');
    }

    public function actionPagePortfolio3Columns1() {
        return $this->render('page-portfolio-3-columns-1');
    }

    public function actionPagePortfolio3Columns2() {
        return $this->render('page-portfolio-3-columns-2');
    }

    public function actionPageJobDetails() {
        return $this->render('page-job-details');
    }

    public function actionPageShoppingCart() {
        return $this->render('page-shopping-cart');
    }

    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
//          return $this->goHome();
//          return $this->goBack();
//          return $this->redirect(['/user/show', 'id' => $id]);
//          return $this->redirect('/user/show');
            return $this->redirect('/');
        }

        $user = new User();
        $user->scenario = User::SCENARIO_LOGIN;

        if ($user->load(Yii::$app->request->post()) && $user->validate()) {
            return $this->redirect('/');
        }

        return $this->render('login', [
            'model' => $user,
        ]);
    }

    public function actionLogout() {
        Yii::$app->user->logout();
//      return $this->goHome();
        return $this->redirect('/');
    }

    public function actionAbout() {
        return $this->render('about');
    }

    public function actionContacts() {
        return $this->render('contacts');
    }

    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->contact()) {
            Yii::$app->session->setFlash('regsuccess', 'Сообщение отправлено.');
//          return $this->refresh();
            return $this->redirect('/');
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

}
