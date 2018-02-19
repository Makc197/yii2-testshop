<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends _BaseController {

    //При первой аутентификации - проверка токена, простановка признака Active, удаление токена из БД 
    public function actionAcceptreg($actkey) {

        $user = new User(['scenario' => User::SCENARIO_FIRSTACTIVATION]);

        if ($user->userActivate($actkey)) {
            return $this->redirect('/');
        }
    }

    //Регистрация нового пользователя
    public function actionRegistration() {
        $user = new User(['scenario' => User::SCENARIO_REGISTRATION]);

        if ($user->load(Yii::$app->request->post()) && $user->regNewUser()) {
            return $this->redirect('/');
        }

        return $this->render('create', [
            'model' => $user,
        ]);
    }

    //Запрос на смену пароля 
    public function actionReqresPassword() {
        $user = new User(['scenario' => User::SCENARIO_RESETPASSWORD]);

        if ($user->load(Yii::$app->request->post()) && $user->reqResPassword()) {
            return $this->redirect('/');
        }

        return $this->render('password-reset', [
            'model' => $user,
        ]);
    }

    //Сброс пароля пользователя
    public function actionPasswordReset($actkey) {

        $user = new User(['scenario' => User::SCENARIO_RESETPASSWORD]);

        if ($user->passwordReset($actkey)) {
            return $this->redirect('/');
        }
    }

}
