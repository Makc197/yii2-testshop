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
            <div class="col-sm-6">
                <!--<div class="basic-login">-->

                    <?php $form = ActiveForm::begin(); ?>

                    <div class="form-group">
                        <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
                    </div>


                    <div class="form-group">
                        <?= Html::submitButton('Сброс пароля', ['class' => 'btn pull-right', 'name' => 'contact-button']) ?>
                        <div class="clearfix"></div>
                    </div>

                    <?php ActiveForm::end(); ?>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>