<?php

namespace app\controllers;

class SiteController extends _BaseController {

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

}