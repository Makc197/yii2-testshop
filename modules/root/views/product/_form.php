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

<div class="product-form" product_id="<?= $model->id ?>">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data', 'id' => 'productform']]); ?>

    <!--<div class="section">
        <div class="container">-->

    <div class="row">   
        <!-- Product Image & Available Colors -->
        <div class="col-lg-4 col-md-6 col-sm-6">
            <!--<div class="product-image-large">-->

            <?php if ($model->id) { ?>
                <div class="form-group field-product-imagefiles">
                    <div class="file-upload">
                        <label>
                            <!--<input type="hidden" name="Product[imageFiles][]" value="">-->
                            <input type="file" form="fakeform" id="product-imagefiles" name="Product[imageFiles][]" multiple="" accept="image/*">
                            <span class="icon-span-filestyle glyphicon glyphicon-folder-open"></span> 
                            <span class="buttonText">  Добавить изображение</span>
                        </label>
                    </div>
                    <span id="result_div_id1"></span>
                </div>
            <?php } ?>

            <div class="form-group">
                <div class="owl-theme owl-carousel">
                    <?php foreach ($model->images as $image) : ?>
                        <div class="item"  id="<?= $image->id ?>">
                            <?= Html::img($path . $image->img, []) ?>
                            <div class="item-remove"><span class="glyphicon glyphicon-trash"></span></div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>

            <!--</div>-->             
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6 product-details">

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

            <?= $form->field($model, 'price')->textInput() ?>

            <?= $form->field($model, 'sale')->textInput() ?>

            <?= $form->field($model, 'count')->textInput() ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-10 product-details">

            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить внесенные изменения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!--    </div>
</div>-->
