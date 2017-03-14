<?php

namespace app\controllers;

use Yii;
use app\models\User;

class UserController extends _BaseController {

    //Функция аутентификации - на вход логин и пароль
    public function actionAuth() {
        //Получаем данные из формы аутентификации - $login, $password
        $login = Yii::$app->request->post('LoginForm')['username'];
        $password = Yii::$app->request->post('LoginForm')['password'];

        echo "login: " . $login . " | password:" . $password;
//        die;
        //Проверяем пару $login $passwhash в таблице users
        //1 - Ищем пользователя по логину
        $user = User::findOne(['login' => $login]);
        echo 'Пользователь найден';
//        var_dump($user);
//        die;
        //Если не найден - не аутентифиц
        //if (isEmpty($user))  echo 'Пользователь не найден';
        if (!isset($user)) {
            echo 'Пользователь не найден';
            die;
//            throw new \yii\web\NotFoundHttpException('Пользователь не найден');
        }

        //2 - Если найден - проверяем хеш пароля
        if ($user->validatePassword(password_hash($password, PASSWORD_DEFAULT))) {
            //3 - Хеш пароля совпал - Все ОК - доступ разрешен
            echo 'Хеш пароля совпал - Все ОК - доступ разрешен';
            die;
//            return $user;
        } else {
            echo 'Хеш пароля не совпал';
            die;
//            throw new \yii\web\NotAcceptableHttpException('Доступ запрещен');
        };
    }

    public function actionAcceptreg($token) {
        //$user = User::findOne(['token'=>$token]);  
        $user = User::findIdentityByAccessToken($token);
        if (isset($user)) {
            throw new \yii\web\NotFoundHttpException('Пользователь не найден');
        } else {
            
        }
    }

    public function actionCreate() {
        $model = new User;

        if ($model->load(Yii::$app->request->post())) {
            //Установим значения вспомогательных полей
            $model->setFieldsval();

            //Валидация перед сохранением
//            if (!($model->validate())) {
//                var_dump($model->errors);
//                die;
//            }
            //if ($model->save()){echo 'save is success', die;}
            if ($model->save()) {
                yii::$app->session->setFlash('regsuccess', 'Пользователь ' . $model->login . ' зарегистрирован');
            }

            //return $this->goHome();
            return $this->goBack();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

}
