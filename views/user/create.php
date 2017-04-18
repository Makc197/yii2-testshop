<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Регистрация пользователя. Введите данные.';
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
    'action' => '/user/registration'
]);
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">

                <div class="form-group">
                    <?= $form->field($model, 'lastname')->textInput(['autofocus' => true]) ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'firstname')->textInput() ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'middlename')->textInput() ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'login')->textInput() ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'email')->textInput() ?>
                </div>

                <div class="form-group">
                    <?=
                    $form->field($model, 'birthday')->textInput()->widget(\yii\widgets\MaskedInput::className(), [
                        'mask' => '99.99.9999'
                    ])
                    ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'password')->passwordInput() ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'reppassword')->passwordInput() ?>
                </div>

                <div class="form-group">
                    <?=
                    $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ])
                    ?>
                </div>

            </div>

        </div>

        <div class="row">

            <div class="col-md-5">
                <?= Html::submitButton('Create', ['class' => 'btn pull-left', 'name' => 'create-user-button']) ?>                     
            </div>

            <div class="col-md-1">
                <button 
                    name="clear"
                    class="btn pull-right"
                    type="reset"
                    onclick="var form = $('#form_1');
                            $('#form_1').find('input[type=text]').each(function (k, el) {
                                $(el).attr('value', null);
                            });
                    " 
                    >Clear</button>
            </div>

        </div>

    </div>
</div>

<?php ActiveForm::end(); ?>