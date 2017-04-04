<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends _BaseController {

    //При первой аутентификации - проверка токена, простановка признака Active, удаление токена из БД 
    public function actionAcceptreg($actkey) {

        $user = new User();

        if ($user->findIdentityByActivateToken($actkey)) {
            return $this->redirect('/');
        }
    }

    //Регистрация нового пользователя
    public function actionRegistration() {
        $user = new User();

        if ($user->load(Yii::$app->request->post()) && $user->regnewuser()) {
            return $this->redirect('/');
        }

        return $this->render('create', [
            'model' => $user,
        ]);
    }

}
