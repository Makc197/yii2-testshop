<?php

namespace app\models;

use Yii;

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
 * @property integer $role_id
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface {

    public $password;
    public $reppassword;
    public $rememberme = false;

    public static function tableName() {
        return 'users';
    }

    const SCENARIO_LOGIN = 'login';
    const SCENARIO_REGISTRATION = 'registration';
    const SCENARIO_FIRSTACTIVATION = 'firstactivation';

    public function scenarios() {
        $scenarios = parent::scenarios();
        //Перечень полей, которые нужно проверять в сценарии - остальные поля исключаются
        $scenarios[self::SCENARIO_LOGIN] = ['login', 'password', 'rememberme'];
        $scenarios[self::SCENARIO_REGISTRATION] = ['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'passwhash', 'reppassword', 'role_id', 'created', 'birthday'];
        $scenarios[self::SCENARIO_FIRSTACTIVATION] = ['emailtoken', 'isactive'];
        return $scenarios;
    }

    public function rules() {
        //Правила валидации - вариант1 - с перечислением сценариев
//        return [
//                [['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'passwhash', 'reppassword', 'role_id', 'created', 'birthday'], 'required', 'on' => 'registration'],
//                [['email'], 'email', 'on' => 'registration'],
//                [['id', 'emailtoken', 'isactive'], 'safe','on' => 'registration', 'firstactivation'],
//                [['birthday'], 'date', 'format' => 'php:d.m.Y', 'on' => 'registration'],
//                [['reppassword'], 'myunique', 'on' => 'registration'], //myunique - самописный валидатор используем при регистрации
//                [['lastname', 'firstname', 'middlename', 'login'], 'string', 'max' => 200,'on' => 'registration'],
//        ];
//        
        //Правила валидации - вариант2 - поля для проверки в сценарии заданы в function scenarios()
        return [
                [['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'passwhash', 'reppassword', 'role_id', 'created', 'birthday'], 'required'],
                [['email'], 'email'],
//              [['password'], 'validatePassword'],
            [['id', 'emailtoken', 'isactive'], 'safe'],
                [['birthday'], 'date', 'format' => 'php:d.m.Y'],
                [['reppassword'], 'myunique'], //myunique - самописный валидатор используем при регистрации
            [['lastname', 'firstname', 'middlename', 'login'], 'string', 'max' => 200],
                [['rememberme'], 'boolean'],
        ];
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
            'role_id' => 'Роль',
            'emailtoken' => 'Auth token',
            'isactive' => 'Статус',
            'rememberme' => 'Запомнить'
        ];
    }

    //<<< ВАЛИДАТОРЫ ===================================================================
    //Валидатор, проверяющий идентичность 2х паролей
    public function myunique($attribute) {

        if ($this->password !== $this->reppassword) {
            $this->addError($attribute, 'Повторный пароль не совпал с первым');
        }
    }

    //Валидатор, проверяющий пароль - Передаем функции пароль - получаем его хеш и сравниваем с хешем в базе данных 
    public function validatePassword($password) {
        return password_hash($password, PASSWORD_DEFAULT) === $this->passwhash;
    }

    //ВАЛИДАТОРЫ >>> ===================================================================
    //<<< ФУНКЦИИ ПОИСКА ПОЛЬЗОВАТЕЛЯ ==================================================
    //Поиск по login(Username)
    public static function findByUsername($login) {
        return self::findOne(['login' => $login]) ?? null;
    }

    //Поиск по ID
    public static function findIdentity($id) {
        //return isset(self::findOne($id)) ? self::findOne($id) : null;
        return self::findOne($id) ?? null;
    }

    //Поиск по логину и паролю при авторизации пользователя
    public function findIdentityByLoginPassword() {
        //Получаем данные из формы аутентификации - $login, $password
        //$password = Yii::$app->request->post('LoginForm')['login'];
        $login = $this->login;
        //$password = Yii::$app->request->post('LoginForm')['password'];
        $password = $this->password;
        $rememberme = $post['rememberme'];
        $this->rememberme = $this->rememberme;
        //echo "login: " . $login . " | password:" . $password . "</br>"; die;
    
        //Ищем пользователя по логину и паролю
        //Получаем хеш пароля
        $passwhash = password_hash($password, PASSWORD_DEFAULT);
        
        //Ищем пользователя в базе по логину и хешу пароля
        $user=self::findOne(['login' => $login], ['passwhash' => $passwhash]);
        
        //Если не найден - не аутентифиц
        if (!isset($user)) {
            echo 'Пользователь не найден';  die;
            //throw new \yii\web\NotFoundHttpException('Пользователь не найден');
            throw new \yii\web\NotAcceptableHttpException('Доступ запрещен');
        } else {
            //echo 'Пользователь по login и password в БД найден - доступ разрешен'.'</br>';
            //var_dump($user); die;
            $user->scenario = User::SCENARIO_LOGIN;
            //Доступ разрешен
            return Yii::$app->user->login($user, $user->rememberme ? 3600 * 24 * 30 : 0);
        }
    }

    //Поиск по токену, отправляемому на указанный e-mail при регистрации пользователя
    public static function findIdentityByAccessToken($emailtoken, $type = null) {
        return self::findOne(['emailtoken' => $emailtoken]);
    }

    //ФУНКЦИИ ПОИСКА ПОЛЬЗОВАТЕЛЯ >>> ==================================================
    //<<< ГЕТТЕРЫ ======================================================================
    public function getId() {
        return $this->id;
    }

    //ГЕТТЕРЫ >>> ======================================================================
    //Установка значений вспомогательных полей при регистрации нового пользователя
    public function setFieldsval() {
        $this->passwhash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->emailtoken = md5($this->login . time());
        $this->role_id = 3;
        $this->created = date('Y-m-d H:i:s');
    }

//    public function beforeValidate() {
//        $this->passwhash = password_hash($this->password, PASSWORD_DEFAULT);      
//        $this->role_id = 1;
//        $this->created = date('Y-m-d H:i:s');
//        return parent::beforeValidate();
//    }   
    //Активация пользователя при первом входе - по токену, отправленному на email
    public function firstActivate() {
        echo 'Активация - firstActivate()' . '</br>';
        //При первом входе - активация - простановка признака Active, удаление токена
        $this->isactive = true;
        $this->emailtoken = null;

        //Сохранение модели и возврат в контроллер флага успешно/неуспешно
        var_dump($this->validate(), $this->getErrors(), $this->save());
        echo '</br>';
        return $this->save();
    }

    //Отправка письма с токеном при регистрации пользователя
    public function sendEmail($registurl) {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
            ->setTo($this->email)
            ->setFrom('TestYiiShop')
            ->setSubject('Подтверждение регистрации')
            ->setTextBody('Для подтверждения регистрации необходимо перейти по следующей ссылке ---> ' . $registurl)
            ->send();
            return true;
        }
        return false;
    }

    //Пока не задействуем - просто реализуем интерфейс \yii\web\IdentityInterface
    public function getAuthKey() {
        
    }

    public function validateAuthKey($authkey) {
        
    }

}
