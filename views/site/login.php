<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<style> 
    .checkbox {
        padding-left: 0px !important;
    }
</style>


<!-- Page Title -->
<div class="section section-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?= Html::encode($this->title) ?></h1>
            </div>
        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <?php $form = ActiveForm::begin([]); ?>

                    <div class="form-group">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            <a href="page-password-reset.html" class="forgot-password">Forgot password?</a>

                        </div>
                        <div class="col-md-6">
                            <?= Html::submitButton('Login', ['class' => 'btn pull-right', 'name' => 'login-button']) ?>
                        </div>
                    </div>

                    <div class="clearfix"></div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div style="color:#999; margin-top: 10px">
            You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
            To modify the username/password, please check out the code <code>app\models\User::$users</code>.
        </div>
    </div>
</div>


