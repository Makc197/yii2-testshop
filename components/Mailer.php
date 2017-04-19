<?php

namespace app\components;

class Mailer {

    public $emailto;
    public $nameto;
    public $reply;
    public $cc;
    public $bcc;
    public $emailfrom;
    public $namefrom;
    public $subject;
    public $body;

    //конструктор класса Mailer
    public function __construct($emailto = 'maks@7jp.ru', $nameto = 'TestShop Admin', $reply = '', $cc = '', $bcc = '', $emailfrom = '', $namefrom = '', $subject = '', $body = '') {
        $this->emailto = $emailto;
        $this->nameto = $nameto;
        $this->reply = $reply;
        $this->cc = $cc;
        $this->bcc = $bcc;
        $this->emailfrom = $emailfrom;
        $this->namefrom = $namefrom;
        $this->subject = $subject;
        $this->body = $body;
    }

    public function sendmail() {
//        echo '<pre>';
//        var_dump($this);
//        die;

        $message = "От кого: " . $this->namefrom . " <" . $this->emailfrom . ">\r\n" .
        "\r\n" . "Текст письма: " . "\r\n" . $this->body . "\r\n";

//        $headers = "From: " . $this->namefrom . " <" . $this->emailfrom . ">\r\n" .
        $headers = "From: " . $this->nameto . " <" . $this->emailto . ">\r\n" .
        'Reply-To: ' . $this->emailto . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        if (mail($this->emailto, $this->subject, $message, $headers)) {
            return true;
        } else {
            throw new \yii\web\ServerErrorHttpException("Ошибка отправки сообщения");
        }
    }

}
