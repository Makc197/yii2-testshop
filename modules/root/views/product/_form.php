<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\models\Category;
use yii\widgets\ActiveForm;

$path = Yii::getAlias('@web/img/products/');

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">
    <div class="col-lg-7">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <div class="form-group field-product-title">
            <label class="control-label" for="product-title">Категория</label>
            <?=
            Html::dropDownList(
            'Product[category_id][]', ArrayHelper::map($model->mmCategoryProducts, 'category_id', 'category_id'), ArrayHelper::map(Category::find()->all(), 'id', 'name'), ['multiple' => 'multiple', 'id' => 'product-category', 'class' => 'form-control']
            )
            ?>
            <div class="help-block"></div>
        </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'price')->textInput() ?>

        <?= $form->field($model, 'sale')->textInput() ?>

        <?= $form->field($model, 'count')->textInput() ?>

        <!-- <?$form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?> -->
        <!-- Вышеуказанная строка генерит след код: -->
        <!-- <div class="form-group field-product-imagefiles">
                 <label class="control-label" for="product-imagefiles">Изображения товара</label>
                 <input type="hidden" name="Product[imageFiles][]" value="">
                 <input type="file" id="product-imagefiles" name="Product[imageFiles][]" multiple="" accept="image/*">
                 <div class="help-block"></div>
             </div> -->

        <div class="form-group field-product-imagefiles">
            <div class="file-upload">
                <label>
                    <input type="hidden" name="Product[imageFiles][]" value="">
                    <input type="file" id="product-imagefiles" name="Product[imageFiles][]" multiple="" accept="image/*">
                    <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> 
                    <span class="buttonText">  Прикрепить изображение</span>
                </label>
            </div>
        </div>

        <!--    <div class="form-group">
                    <div class="bootstrap-filestyle input-group">
                        <span class="group-span-filestyle " tabindex="0">
                            <label for="filestyle-1" class="btn btn-default ">
                                <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> 
                                <span class="buttonText">Choose file</span>
                            </label>
                        </span>
                    </div>
                </div> -->

        <div class="form-group">
             <div class="owl-theme owl-carousel">
                <?php foreach ($model->images as $image) : ?>
                    <div class="item">
                        <?= Html::img($path . $image->img, []) ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить внесенные изменения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>
