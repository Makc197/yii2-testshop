<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\Models\Order */

$this->title = 'Update Order: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="order-update">

    <!--<h1><= Html::encode($this->title) ?></h1>-->
    <div class="section">
        <div class="container">
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>
        </div>
    </div>
</div>
