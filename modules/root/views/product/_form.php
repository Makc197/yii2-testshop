<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-product-title">
        <label class="control-label" for="product-title">Категория</label>
        <?= Html::dropDownList(
            'Product[category_id][]', 
            ArrayHelper::map($model->mmCategoryProducts, 'category_id', 'category_id'), 
            ArrayHelper::map(Category::find()->all(), 'id', 'name'), 
            ['multiple' => 'multiple', 'id' => 'product-category', 'class' => 'form-control']
        ) ?>
        <div class="help-block"></div>
    </div>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'sale')->textInput() ?>

    <?= $form->field($model, 'count')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Внести изменения', 
        ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
