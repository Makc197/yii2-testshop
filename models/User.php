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

    public function rules() {
        return [
                [['lastname', 'firstname', 'middlename', 'login', 'email', 'password', 'passwhash', 'reppassword', 'role_id', 'created', 'birthday'], 'required'],
                [['email'], 'email'],
                [['id', 'emailtoken'], 'safe'],
                [['birthday'], 'date', 'format' => 'php:d.m.Y'],
                [['reppassword'], 'myunique'],
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
            'emailtoken' => 'Auth token'
        ];
    }

    //Валидатор проверяющий идентичность 2х паролей
    public function myunique($attribute) {

        if ($this->password !== $this->reppassword) {
            $this->addError($attribute, 'Повторный пароль не совпал с первым');
        }
    }

    //Установка значений вспомогательных полей
    public function setFieldsval() {
        $this->passwhash = password_hash($this->password, PASSWORD_DEFAULT);
        $this->emailtoken = md5($this->login . time());
        $this->role_id = 1;
        $this->created = date('Y-m-d H:i:s');
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

    //Идентификация по токену, отправляемому при регистрации пользователя письмом
    public static function findIdentityByAccessToken($emailtoken, $type = null) {
        $user = self::findOne(['emailtoken' => $emailtoken]);
        if ($user->emailtoken === $emailtoken) {
            return $user;
        }
    }

    //Пока не задействуем - просто реализуем интерфейс \yii\web\IdentityInterface
    public function getAuthKey() {
        
    }

    public function validateAuthKey($authkey) {
        
    }

}
