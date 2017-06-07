<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Оформление заказа';

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form ActiveForm */
?>


<div class="section">
    <div class="container">
        <div class="order-order">
            <div class="row">
                <div class="col-md-8 col-lg-8">

                    <?php $form = ActiveForm::begin(); ?>

                    <?= var_dump($arrprice) ?>

                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'zipcode') ?>
                    <?= $form->field($model, 'city') ?>
                    <?= $form->field($model, 'street') ?>
                    <?= $form->field($model, 'house') ?>
                    <?= $form->field($model, 'build') ?>
                    <?= $form->field($model, 'room') ?>
                    <?= $form->field($model, 'delivery_type') ?>
                    <?= $form->field($model, 'user_id') ?>


                    <div class="form-group">
                        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>

        </div>
    </div>
</div>

