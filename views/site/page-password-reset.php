<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Сброс пароля';
$this->params['breadcrumbs'][] = ['label' => 'Вход', 'url' => ['/site/login']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section">
    <div class="container">
        <div class="row">

            <div class="col-sm-6 col-sm-offset-3">
                <div class="basic-login">
                    
                    <?php
                    $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => '/user/reset-password'
                    ]);
                    ?>
                    
                    <div class="form-group">
                        <label for="restore-email"><i class="icon-envelope"></i> <b>Enter Your Email</b></label>
                        <input class="form-control" id="restore-email" type="text" placeholder="">
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('Сброс пароля', ['class' => 'btn pull-right', 'name' => 'contact-button']) ?>
                        <div class="clearfix"></div>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>

        </div>
    </div>
</div>