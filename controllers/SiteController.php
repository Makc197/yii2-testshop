<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller {

    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                        [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
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
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex() {
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

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
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
