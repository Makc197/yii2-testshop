<?php

namespace app\controllers;

use Yii;
use app\models\User;
use \yii\helpers\Url;

class UserController extends _BaseController {

    //Метод аутентификации
    public function actionAuth() {

        $user = new User();
        $user->scenario = User::SCENARIO_LOGIN;

        if ($user->load(Yii::$app->request->post()) && $user->findIdentityByLoginPassword()) {
            return $this->goBack();
        }
        
    }

    //При первой аутентификации - проверка токена, простановка признака Active, удаление токена из БД 
    public function actionAcceptreg($actkey) {
        //Поиск пользователя по токену
        //$user = User::findOne(['emailtoken' => $emailtoken]); 
        $user = User::findIdentityByAccessToken($actkey);

        //Если не найден - доступ запрещен
        if (!$user) {
            throw new \yii\web\NotAcceptableHttpException('Доступ запрещен');
        } else {
            //echo 'Пользователь по токену найден'.'</br>';
            $user->scenario = User::SCENARIO_FIRSTACTIVATION;
            //При первом входе - активация (простановка признака Active, удаление токена)
            if ($user->firstActivate()) {
                //echo 'Ваша учетная запись активирована'; die;
                //yii::$app->session->setFlash('regsuccess', 'Ваша учетная запись активирована');
                return $user; //Доступ разрешен - возвращаем объект $user             
            } else {
                //echo 'Ошибка активации'; die;
                throw new \yii\web\NotAcceptableHttpException('Доступ запрещен');
            }
        }
    }

    public function actionCreate() {
        $user = new User();
        $user->scenario = User::SCENARIO_REGISTRATION;

        if ($user->load(Yii::$app->request->post())) {
            //Установим значения вспомогательных полей
            $user->setFieldsval();

            //Валидация перед сохранением
//            if (!($user->validate())) {
//                var_dump($user->errors);
//                die;
//            }           
//           if ($user->save()){echo 'save is success', die;}

            if ($user->validate() && $user->save()) {
                $registurl = Url::toRoute(['user/acceptreg', 'actkey' => $user->emailtoken], true);
                //Отправка на e-mail пользователя ссылки с GET параметром где токен для аутентификации
//              $user->sendEmail($registurl);
//              yii::$app->session->setFlash('regsuccess', 'Пользователь ' . $user->login . ' зарегистрирован'.'</br>'.'Для подтверждения регистрации необходимо перейти по ссылке, отправленной на Ваш e-mail');
                yii::$app->session->setFlash('regsuccess', 'Пользователь ' . $user->login . ' зарегистрирован' . '</br>' . 'Для подтверждения регистрации необходимо перейти по ' . '<a href="' . $registurl . '">ссылке, отправленной на Ваш e-mail</a>');
            }

            //return $this->goHome();
            return $this->goBack();
        }

        return $this->render('create', [
            'model' => $user,
        ]);
    }

}
