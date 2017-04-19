<?php

namespace app\models;

use yii\base\Model;
use app\components\Mailer;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model {

    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels() {
        return [
            'verifyCode' => 'Проверочный код',
            'name' => 'Ваше имя',
            'email' => 'Ваш email',
            'subject' => 'Тема письма',
            'body' => 'Текст сообщения',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact() {

        $emailto = 'maks@7jp.ru';   // Отправка всегда на свой ящик - maks@7jp.ru от себя- maks@7jp.ru
        $nameto = 'TestShop Admin'; // Для отображения в письме
        $subject = $this->subject;  // Тема письма - указана пользователем
        $namefrom = $this->name; // От кого - имя указанное пользователем
        $emailfrom = $this->email; // От кого - email указанный пользователем
        $body = $this->body; // Тело письма
//v1 - Отправка почты через \PHPMailer - реализация в классе MailerSmtp()     
//      $mailer = new MailerSmtp();
//v2 - Отправка почты через функцию mailer - реализация в классе Mailer()
        $mailer = new Mailer();
        $mailer->emailto = $emailto;
        $mailer->nameto = $nameto;
        $mailer->subject = $subject;
        $mailer->namefrom = $namefrom;
        $mailer->emailfrom = $emailfrom;
        $mailer->body = $body;
        return $mailer->sendmail();
    }

}
