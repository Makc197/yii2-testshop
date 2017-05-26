<?php

namespace app\controllers;

use yii\web\Response;
use yii\widgets\ActiveForm;

abstract class _Modal extends _BaseController {

    protected static $model_name;
    protected static $view_form_name = '_modal_form';

    public function actionModal($id = null, $data = []) {
        if ($id) {
            $model = (static::$model_name)::findOne($id);
        } else {
            $model = new static::$model_name;        
        }
        $params = array_merge(['model' => $model], $data);
        return $this->renderAjax(static::$view_form_name, $params);
    }

    public function actionValidate() {
        /**
         * @var $model \yii\db\ActiveRecord
         */
        $model = new static::$model_name();
        if ($model->load(\Yii::$app->request->post())) {
            $model->validate();
            \Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        return false;
    }

    public function actionAdd() {
        /**
         * @var $model \yii\db\ActiveRecord
         */
        $model = new static::$model_name();
        if ($model->load(\Yii::$app->request->post())) {
            $model->save();
        }
        return $this->redirect(\Yii::$app->request->referrer);
    }

    public function actionDelete($id) {
        (static::$model_name)::findOne($id)->delete();
        return $this->redirect(\Yii::$app->request->referrer);
    }

}
