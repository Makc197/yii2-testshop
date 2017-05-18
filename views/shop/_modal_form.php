<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

$form = ActiveForm::begin(
[
    'id' => 'chart-item',
    'action' => Url::to("/shop/add"),
    'enableAjaxValidation' => true,
    'validationUrl' => Url::to("/shop/validate"),
]
);
$chartitem = $model;
?>

<h3>Добавление товара в корзину</h3>
<h4>Укажите необходимое количество</h4>
<?= $form->field($chartitem, 'id')->hiddenInput(['value' => $id])->label(false); ?>
<?= $form->field($chartitem, 'count'); ?>

<?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success']); ?>

<?php ActiveForm::end(); ?>


