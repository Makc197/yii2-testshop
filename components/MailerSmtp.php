<?php

namespace app\components;

class MailerSmtp {

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

        $phpmailer = new \PHPMailer;
        $phpmailer->SMTPDebug = 4;                                 // Enable verbose debug output
        $phpmailer->isSMTP();                                      // Set mailer to use SMTP
        $phpmailer->Host = 'smtp.yandex.ru';                       // Specify main and backup SMTP servers
        $phpmailer->SMTPAuth = true;                               // Enable SMTP authentication
        $phpmailer->Username = 'email@yandex.ru';                      // SMTP username
        $phpmailer->Password = 'password';                         // SMTP password
//      $phpmailer->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//      $phpmailer->Port = 465;                                    // TCP port to connect to
        $phpmailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
        $phpmailer->Port = 587;                                    // TCP port to connect to
        $phpmailer->CharSet = 'UTF-8';
        $phpmailer->isHTML(true);

      $phpmailer->setFrom($this->emailfrom, $this->namefrom);
        $phpmailer->addAddress($this->emailto, $this->nameto);           // Add a recipient
//      $phpmailer->addAddress('test@example.com');                 // Name is optional
//      $phpmailer->addReplyTo($this->reply, '');
//      $phpmailer->addCC($this->cc);
//      $phpmailer->addBCC($this->bcc);
//      $phpmailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//      $phpmailer->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
//      $phpmailer->isHTML(true);                                  // Set email format to HTML

        $phpmailer->Subject = $this->subject;
        $phpmailer->Body = $this->body; //'This is the HTML message body <b>in bold!</b>';
//      $phpmailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

        if (!$phpmailer->send()) {
            throw new \yii\web\ServerErrorHttpException('Письмо не отправлено'. $phpmailer->ErrorInfo);
        } else {
            return true;
        }
    }

}
