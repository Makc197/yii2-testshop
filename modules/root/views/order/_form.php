<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\Models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php
    $form = ActiveForm::begin([
        'id' => 'form-order',
        'method' => 'post',
        'action' => '/root/order/update?id=' . $model->id,
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
    ]);
    ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'email')->textInput() ?>

    <?= $form->field($model, 'zipcode')->textInput() ?>

    <?= $form->field($model, 'city')->textInput() ?>

    <?= $form->field($model, 'street')->textInput() ?>

    <?= $form->field($model, 'house')->textInput() ?>

    <?= $form->field($model, 'build')->textInput() ?>

    <?= $form->field($model, 'room')->textInput() ?>

    <?php
    $items = [
        '1' => 'Доставка курьером',
        '2' => 'Доставка почтой'
    ];
    $params = [
        'prompt' => 'Выберите тип доставки...'
    ];
    echo $form->field($model, 'delivery_type')->dropDownList($items, $params);
    ?>

    <?= $form->field($model, 'order_number')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Изменить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
