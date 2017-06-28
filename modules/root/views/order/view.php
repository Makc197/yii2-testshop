<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\Models\Order */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="order-view">

                <p>
                    <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Вы уверены что хотите удалить данный заказ?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </p>

                <?=
                DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        'id',
                        'name',
                        'phone',
                        'email:email',
                        'zipcode',
                        'city',
                        'street',
                        'house',
                        'build',
                        'room',
                        'user_id',
                        'delivery_type',
                        'order_number',
                    ],
                ])
                ?>

            </div>
        </div>
    </div>
</div>