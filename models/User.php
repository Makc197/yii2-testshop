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

    public static function tableName() {
        return 'users';
    }

    const SCENARIO_REGISTRATION = 'registration';
    const SCENARIO_FIRSTACTIVATION = 'firstactivation';

    public function scenarios() {
        $scenarios = parent::scenarios();
        //Перечень полей, которые нужно проверять в сценарии - остальные поля исключаются
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
        
        //Правила валидации - вариант2 - поля для проверки в сценарии заданы в function scenarios()
        return [
                [['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'passwhash', 'reppassword', 'role_id', 'created', 'birthday'], 'required'],
                [['email'], 'email'],
                [['id', 'emailtoken', 'isactive'], 'safe'],
                [['birthday'], 'date', 'format' => 'php:d.m.Y'],
                [['reppassword'], 'myunique'], //myunique - самописный валидатор используем при регистрации
                [['lastname', 'firstname', 'middlename', 'login'], 'string', 'max' => 200],
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
            'isactive' => 'Статус'
        ];
    }

    //Валидатор, проверяющий идентичность 2х паролей
    public function myunique($attribute) {

        if ($this->password !== $this->reppassword) {
            $this->addError($attribute, 'Повторный пароль не совпал с первым');
        }
    }

    //Установка значений вспомогательных полей
    public function setFieldsval() {
        $this->passwhash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->emailtoken = md5($this->login . time());
        $this->role_id = 3;
        $this->created = date('Y-m-d H:i:s');
    }

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

//    public function beforeValidate() {
//        $this->passwhash = password_hash($this->password, PASSWORD_DEFAULT);      
//        $this->role_id = 1;
//        $this->created = date('Y-m-d H:i:s');
//        return parent::beforeValidate();
//    }
    //Find By Login (Username)
    public static function findByUsername($login) {
        return self::findOne(['login' => $login]) ?? null;
    }

    public static function findIdentity($id) {
        //return isset(self::findOne($id)) ? self::findOne($id) : null;
        return self::findOne($id) ?? null;
    }

    public function getId() {
        return $this->id;
    }

    public function validatePassword($passwhash) {
        return $this->passwhash === $passwhash;
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

    //Идентификация по токену, отправляемому при регистрации пользователя письмом
    public static function findIdentityByAccessToken($emailtoken, $type = null) {
        return self::findOne(['emailtoken' => $emailtoken]);
    }

    //Пока не задействуем - просто реализуем интерфейс \yii\web\IdentityInterface
    public function getAuthKey() {
        
    }

    public function validateAuthKey($authkey) {
        
    }

}
