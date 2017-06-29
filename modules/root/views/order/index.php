<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\Models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/root/product']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section">
    <div class="container">
        <div class="order-index">

<!--       <p>
                <= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
            </p>-->
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'pager' => [
                    'options' => ['class' => 'pagination pagination-lg'],
                    'nextPageLabel' => 'Вперед',
                    'prevPageLabel' => 'Назад'
                ],
                'layout' => '{summary}{items}<div class="pagination-wrapper">{pager}</div>',
                'columns' => [
//                    ['class' => 'yii\grid\SerialColumn'],
                        [
                        'attribute' => 'id',
                        'headerOptions' => ['width' => '80'],
                    ],
                    'order_number',
                        [
                        'header' => 'Тип доставки',
                        'attribute' => 'delivery_type',
                        'filter' => [
                            1 => 'Доставка курьером',
                            2 => 'Доставка почтой'],
                        'format' => 'raw',
                        'value' => function($data) {
                            switch ($data->delivery_type) {
                                case 1:
                                    return 'Доставка курьером';
                                    break;
                                case 2:
                                    return 'Доставка почтой';
                                    break;
                            }
                        }
                    ],
                    'name',
                    'phone',
                    'email:email',
//                    'zipcode',
                    'city',
                    'street',
                    'house',
                    'build',
                    'room',
//                     'user_id',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => 'Действия',
                        'headerOptions' => ['width' => '80'],
                        'template' => '{view} {update} {delete} {link}',
                    ],
                ],
            ]);
            ?>
        </div>
    </div>
</div>
