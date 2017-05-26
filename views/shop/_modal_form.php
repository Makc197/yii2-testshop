<?php

use yii\bootstrap\ActiveForm;
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

<h5><?= isset($chartitem->count) ? 'В корзине уже есть такой товар. Измените количество товара в корзине:' : 'Укажите необходимое количество:'; ?></h5>
<?= $form->field($chartitem, 'id')->hiddenInput(['value' => $id])->label(false); ?>
<?= $form->field($chartitem, 'count')->textInput()->label(false); ?>

<?= Html::submitButton('Подтвердить', ['class' => 'btn btn-success modal-submit', 'data-target' => '#ModalWindow']); ?>

<?php ActiveForm::end(); ?>
