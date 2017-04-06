<?php

namespace app\components;

class Mailer {

    public $from = 'maks@7jp.ru';
    public $namefrom = 'Admin';
    public $subject = 'Mail from maks@7jp.ru';
    public $body = '';
    public $to = '';
    public $nameto = '';
    public $reply = '';
    public $cc = '';
    public $bcc = '';

    public function sendmail() {

        $phpmailer = new \PHPMailer;
        $phpmailer->SMTPDebug = 4;                                 // Enable verbose debug output

        $phpmailer->isSMTP();                                      // Set mailer to use SMTP
        $phpmailer->Host = 'smtp.yandex.ru';                       // Specify main and backup SMTP servers
        $phpmailer->SMTPAuth = true;                               // Enable SMTP authentication
        $phpmailer->Username = 'maks@7jp.ru';                      // SMTP username
        $phpmailer->Password = 'passw0rd';                         // SMTP password
        $phpmailer->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $phpmailer->Port = 465;                                    // TCP port to connect to
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->isHTML(true);
        
        $phpmailer->setFrom($this->from, $this->namefrom);
        $phpmailer->addAddress($this->to, $this->nameto);     // Add a recipient
//      $phpmailer->addAddress('test@example.com');    // Name is optional
//      $phpmailer->addReplyTo($this->reply, '');
//      $phpmailer->addCC($this->cc);
//      $phpmailer->addBCC($this->bcc);
//      $phpmailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//      $phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//      $phpmailer->isHTML(true);                                  // Set email format to HTML

        $phpmailer->Subject = $this->subject;
        $phpmailer->Body = $this->body; //'This is the HTML message body <b>in bold!</b>';
//      $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';
//        echo 'От: ' . $this->from . '</br>';
//        echo 'Кому: ' . $this->to . '</br>';
//        echo 'Тема: ' . $this->subject . '</br>';
//        echo 'Тело письма: ' . $phpmailer->Body . '</br>';
//        die;

        if (!$phpmailer->send()) {
            echo '<pre>';
          echo 'Message could not be sent.';
          echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
          die;
            throw new \yii\web\ServerErrorHttpException($phpmailer->ErrorInfo);
        } else {
//          echo 'Message has been sent';
            return true;
        }
    }

}
