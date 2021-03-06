<?php

namespace app\modules\root\controllers;

use yii\web\Controller;

/**
 * Default controller for the `root` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('/');
    }
}
