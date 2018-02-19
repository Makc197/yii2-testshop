<?php

namespace app\models;

use Yii;
use \yii\helpers\Url;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $created
 * @property string $lastname
 * @property string $firstname
 * @property string $middlename
 * @property string $login
 * @property string $passwhash
 * @property string $birthday
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $password;
    public $reppassword;
    public $rememberme = false;
    public $verifyCode;

    public static function tableName() {
        return 'user';
    }

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTRATION = 'registration';
    const SCENARIO_FIRSTACTIVATION = 'firstactivation';
    const SCENARIO_RESETPASSWORD = 'resetpassword';

    public function scenarios() {
        $scenarios = parent::scenarios();
        //Перечень полей, которые нужно проверять в сценарии - остальные поля исключаются
        $scenarios[self::SCENARIO_LOGIN] = ['login', 'password', 'rememberme'];
        $scenarios[self::SCENARIO_REGISTRATION] = ['lastname', 'firstname', 'middlename', 'login', 'email', 'passwhash', 'password', 'reppassword', 'created', 'birthday', 'captcha'];
        $scenarios[self::SCENARIO_FIRSTACTIVATION] = ['emailtoken', 'isactive'];
        $scenarios[self::SCENARIO_RESETPASSWORD] = ['email'];
        return $scenarios;
    }

    public function rules() {

//      Правила валидации - вариант1 - с перечислением сценариев
        return [
            [['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'reppassword', 'created', 'birthday'], 'required', 'on' => self::SCENARIO_REGISTRATION],
            [['email'], 'email', 'on' => self::SCENARIO_REGISTRATION],
            [['birthday'], 'date', 'format' => 'dd.mm.yyyy', 'on' => self::SCENARIO_REGISTRATION],
            [['lastname', 'firstname', 'middlename', 'login'], 'string', 'max' => 200, 'on' => self::SCENARIO_REGISTRATION],
            [['reppassword'], 'passunique', 'on' => self::SCENARIO_REGISTRATION], //passunique - самописный валидатор используем при регистрации
            [['password'], 'validatePassword', 'on' => self::SCENARIO_LOGIN],
            [['id', 'emailtoken', 'isactive'], 'safe', 'on' => [self::SCENARIO_REGISTRATION, self::SCENARIO_FIRSTACTIVATION]],
            [['verifyCode'], 'captcha', 'on' => self::SCENARIO_REGISTRATION],
        ];

//      Правила валидации - вариант2 - поля для проверки в сценарии заданы в function scenarios()
//        return [
//                [['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'passwhash', 'reppassword', 'birthday'], 'required'],
//                [['email'], 'email'],
//                [['id', 'emailtoken', 'isactive'], 'safe'],
//                [['birthday'], 'date', 'format' => 'dd.mm.yyyy'],
//                [['reppassword'], 'passunique'], //passunique - самописный валидатор используем при регистрации
//                [['lastname', 'firstname', 'middlename', 'login'], 'string', 'max' => 200],
//                [['rememberme'], 'boolean'],
//                [['login'], 'loginunique'],
//                ['password', 'validatePassword'],
//                ['verifyCode', 'captcha'],
//        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'created' => 'Created',
            'lastname' => 'Фамилия',
            'firstname' => 'Имя',
            'middlename' => 'Отчество',
            'login' => 'Login',
            'email' => 'E-mail',
            'birthday' => 'День рождения',
            'passwhash' => 'Passwhash',
            'password' => 'Пароль',
            'reppassword' => 'Пароль еще раз',
            'emailtoken' => 'Auth token',
            'isactive' => 'Статус',
            'rememberme' => 'Запомнить',
            'verifyCode' => 'Проверочный код'
        ];
    }

    public function validatePassword($attribute) {

        if (!$this->hasErrors()) {
            $user = $this->findByUsername($this->login);
            
            

            if ($user && Yii::$app->getSecurity()->validatePassword($this->password, $user->passwhash) && $user->isactive) {
                //Доступ разрешен
//                echo '<pre>';
//                echo 'Доступ разрешен';
//                var_dump($user); die;
                return Yii::$app->user->login($user, $this->rememberme ? 3600 * 24 * 30 : 0);
            } else {
                $this->addError($attribute, 'Неправильный логин или пароль');
            }
        }
    }

    //Валидатор, проверяющий идентичность 2х паролей
    public function passunique($attribute) {

        if ($this->password !== $this->reppassword) {
            $this->addError($attribute, 'Повторный пароль не совпал с первым');
        }
    }

    //Валидатор, проверяющий уникальность логина
    public function loginunique($login) {
        $user = $this->findByUsername($login);
        if (isset($user)) {
            $this->addError($login, 'Пользователь с таким Login уже существует. Придумайте другой.');
        }
    }

    //Валидатор, проверяющий пароль по хешу - Передаем функции пароль - получаем его хеш и сравниваем с хешем в базе данных 
    public function validatePasswordhash($password) {
        return password_hash($password, PASSWORD_DEFAULT) === $this->passwhash;
    }

    //Регистрация нового пользователя
    public function regNewUser() {
//        $this->scenario = User::SCENARIO_REGISTRATION;
        //Установим значения вспомогательных полей
        $this->passwhash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        $this->emailtoken = md5($this->login . time());
        $this->created = date('Y-m-d H:i:s');

//        echo '<pre>';
//        var_dump($this);
//        var_dump($this->validate(), $this->getErrors(), $this->save());
//        die;

        if ($this->validate() && $this->save()) {
            $registurl = Url::toRoute(['user/acceptreg', 'actkey' => $this->emailtoken], true);
            //Отправка на e-mail пользователя ссылки с GET параметром где токен для аутентификации
            /* Yii::$app->mailer->compose()
              ->setTo($this->email)
              ->setFrom('TestYiiShop')
              ->setSubject('Подтверждение регистрации')
              ->setTextBody('Для подтверждения регистрации необходимо перейти по следующей ссылке ---> ' . $registurl)
              ->send();
              yii::$app->session->setFlash('regsuccess', 'Пользователь ' . $this->login . ' зарегистрирован' . '</br>' . 'Для подтверждения регистрации необходимо перейти по ссылке, отправленной на Ваш e-mail'); */
            yii::$app->session->setFlash('regsuccess', 'Пользователь ' . $this->login . ' зарегистрирован' . '</br>' . 'Для подтверждения регистрации необходимо перейти по ' . '<a href="' . $registurl . '">ссылке, отправленной на Ваш e-mail</a>');
            return true;
        } else {
            return false;
        }
    }

    public function userActivate($actkey) {
        $user = $this->findIdentityByActivateToken($actkey);
        $user->scenario = User::SCENARIO_FIRSTACTIVATION;

        //Если не найден - доступ запрещен
        if (empty($user)) {
            throw new \yii\web\NotAcceptableHttpException('Доступ запрещен');
        } else {
            //echo 'Пользователь по токену найден'.'</br>';
            //При первом входе - активация - простановка признака Active, удаление токена
            $user->isactive = true;
            $user->emailtoken = null;
            //Сохранение модели и возврат в контроллер флага успешно/неуспешно
            //var_dump($this->validate(), $this->getErrors(), $this->save());
            if ($user->save()) {
                yii::$app->session->setFlash('regsuccess', 'Ваша учетная запись активирована');
                return true;
            } else {
                //echo 'Ошибка активации'; die;
                throw new \yii\web\NotAcceptableHttpException('Доступ запрещен');
            }
        }
    }

    //Запрос на сброс пароля
    public function reqResPassword() {

        $this->scenario = User::SCENARIO_RESETPASSWORD;
        if ($this->validate()) {
            $user = $this->findByEmail($this->email);
            $user->scenario = User::SCENARIO_RESETPASSWORD;
        }

        if (!empty($user)) {
            //var_dump($user->attributes); die;
            $user->emailtoken = md5($user->email . time());
            $registurl = Url::toRoute(['user/password-reset', 'actkey' => $user->emailtoken], false);
            //Отправка на e-mail пользователя ссылки с GET параметром где токен для аутентификации
            yii::$app->session->setFlash('regsuccess', 'Для подтверждения смены пароля необходимо перейти ' . '<a href="' . $registurl . '">по данной ссылке</a>');
            return $user->save();
        } else {
            return false;
        }
    }

    //Сброс пароля
    public function passwordReset($acttoken, $type = null) {
        $user = $this->findIdentityByActivateToken($acttoken);
        $user->scenario = User::SCENARIO_RESETPASSWORD;

        if (!empty($user)) {
            $passtoken = substr(md5($acttoken . time()), 10, 7);
            $user->passwhash = Yii::$app->getSecurity()->generatePasswordHash($passtoken);
            yii::$app->session->setFlash('regsuccess', 'Ваш новый пароль: ' . $passtoken . '</br>');
            return $user->save();
        }
    }

    //Поиск по login(Username)
    public function findByUsername($login) {
        return self::findOne(['login' => $login]) ?? null;
    }

    //Поиск пользователя по e-mail
    public function findByEmail($email) {
        return self::findOne(['email' => $email]) ?? null;
    }

    //Поиск по ID
    public static function findIdentity($id) {
        //return isset(self::findOne($id)) ? self::findOne($id) : null;
        return self::findOne($id) ?? null;
    }

    //Поиск по токену, отправляемому на указанный e-mail при регистрации пользователя
    public static function findIdentityByActivateToken($emailtoken, $type = null) {
        //Поиск пользователя по токену
        return self::findOne(['emailtoken' => $emailtoken]);
    }

    public function getId() {
        return $this->id;
    }

    //Установка значений вспомогательных полей при регистрации нового пользователя
    /*    public function beforeValidate() {
      $this->passwhash = password_hash($this->password, PASSWORD_DEFAULT);
      $this->created = date('Y-m-d H:i:s');
      return parent::beforeValidate();
      } */

    public function beforeSave($insert) {
        if (parent::beforeSave($insert)) {
            $this->birthday = (new \DateTime($this->birthday))->format('Y-m-d');
            return true;
        }
        return false;
    }

    public function getFBirthday() {
        return (new \DateTime($this->birthday))->format('d.m.Y');
    }

    //Пока не задействуем - просто реализуем интерфейс \yii\web\IdentityInterface
    public function getAuthKey() {
        
    }

    public function validateAuthKey($authkey) {
        
    }

    public static function findIdentityByAccessToken($token, $type = NULL) {
        
    }

}
