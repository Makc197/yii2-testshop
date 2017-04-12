<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\ContactForm;

class SiteController extends _BaseController {

    /**
     * Displays homepage.
     *
     * @return string
     */
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
        return $this->render('page-job-details');
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

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
//          return $this->goHome();
//          return $this->goBack();
//          return $this->redirect(['/user/show', 'id' => $id]);
//          return $this->redirect('/user/show');
            return $this->redirect('/');
        }

        $user = new User();

        if ($user->load(Yii::$app->request->post()) && $user->findIdentityByLoginPassword()) {
//          return $this->goBack();
            return $this->redirect('/');
        }

        return $this->render('login', [
            'model' => $user,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        Yii::$app->user->logout();
//      return $this->goHome();
        return $this->redirect('/');
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
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

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout() {
        return $this->render('about');
    }

    public function actionPagePasswordReset() {
        return $this->render('page-password-reset');
    }

}
