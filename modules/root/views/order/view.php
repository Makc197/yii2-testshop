<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;

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
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    'pager' => [
                        'options' => ['class' => 'pagination pagination-lg'],
                        'nextPageLabel' => 'Вперед',
                        'prevPageLabel' => 'Назад'
                    ],
                    'layout' => '{summary}{items}<div class="pagination-wrapper">{pager}</div>',
                    'columns' => [
                            ['class' => 'yii\grid\SerialColumn'],
                            ['attribute' => 'title',
                            'label' => 'Наименование',
                            'format' => 'html',
                            'value' => function($data, $id) {
                                return //print_r($k,1);
                                Html::a(
                                $data["title"], Url::to(['/shop/page-product-details', 'product_id' => $id, 'category_id' => $categoryid]), [
                                    'target' => '_blank'
                                ]
                                );
                            }
                        ],
                            ['attribute' => 'article',
                            'label' => 'Артикул'],
                            ['attribute' => 'price',
                            'label' => 'Цена'],
                            ['attribute' => 'count',
                            'label' => 'Количество'],
                            ['attribute' => 'totalprice_product',
                            'label' => 'Сумма'],
                    ],
                ]);
                ?>

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