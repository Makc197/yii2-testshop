<?php

if (!empty($model->errors)) {
    $str = '';
    foreach ($model->errors as $err) {
        foreach ($err as $key => $value) {
            $str = $str . '</br>' . $value;
        }
    }
    echo $str;
}