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
             //['verifyCode', 'captcha'],
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

//      $mailer = new Mailer();
//      $mailer->to = $this->email;
//      $mailer->nameto = $this->name;
//      $mailer->subject = $this->subject;
//      $mailer->body = $this->body;   
//      return $mailer->sendmail();

        $to = 'maks@7jp.ru';
        $subject = $this->subject;
        $message = "От кого: " . $this->name . " <" . $this->email . ">\r\n" .
        "\r\n" . "Текст письма: " . "\r\n" . $this->body . "\r\n";
        $headers = "From: " . $this->name . " <" . $this->email . ">\r\n" .
        'Reply-To: ' . $to . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            return true;
        } else {
            throw new \yii\web\ServerErrorHttpException("Ошибка отправки сообщения");
        }
    }

}
