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

<?php
$form = ActiveForm::begin([
    'method' => 'post',
    'action' => '/site/login'
]);
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <div class="form-group">
                    <?= $form->field($model, 'login')->textInput(['autofocus' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($model, 'rememberme')->checkbox() ?>
                    </div>

                    <div class="col-md-6">
                        <?= Html::submitButton('Login', ['class' => 'btn pull-right', 'name' => 'login-button']) ?>                     
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <a href="page-password-reset.html" class="forgot-password">Forgot password?</a>
                    </div>

                    <div class="col-md-6">
                        <?= Html::a('Register new user', '/user/registration', ['class' => 'btn pull-right', 'name' => 'register-button']) ?>  
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
