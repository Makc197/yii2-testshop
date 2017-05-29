<?php

namespace app\components;

class MyException extends \yii\web\HttpException {

    public function __construct($status, $message = null, $code = 0, \Exception $previous = null) {
        $this->statusCode = $status;
        parent::__construct($message, $code, $previous);
    }

    public function getName() {

        return '';
    }

}
