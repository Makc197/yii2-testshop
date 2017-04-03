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

    public function actionFeatures() {
        return $this->render('features');
    }

    public function actionPageHomepageSample() {
        return $this->render('page-homepage-sample');
    }

    public function actionPagePortfolioItem() {
        return $this->render('page-portfolio-item');
    }

    public function actionPageServices1Column() {
        return $this->render('page-services-1-column');
    }

    public function actionPageServices3Columns() {
        return $this->render('page-services-3-columns');
    }

    public function actionPageServices4Columns() {
        return $this->render('page-services-4-columns');
    }

    public function actionPagePricing() {
        return $this->render('page-pricing');
    }

    public function actionPageTeam() {
        return $this->render('page-team');
    }

    public function actionPageVacancies() {
        return $this->render('page-vacancies');
    }

    public function actionPageJobDetails() {
        return $this->render('page-job-details');
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
            return $this->goHome();
        }

        $user = new User();
        $user->scenario = User::SCENARIO_LOGIN;
        
        if ($user->load(Yii::$app->request->post()) && $user->findIdentityByLoginPassword()) {
            return $this->goBack();
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

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
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

}
