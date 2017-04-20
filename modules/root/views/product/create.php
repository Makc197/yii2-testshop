<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = 'Создать запись в базе';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/root/product']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section">
    <div class="container">
        <div class="product-create">

            <!--<h1><= Html::encode($this->title) ?></h1>-->

            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>

        </div>
    </div>
</div>
