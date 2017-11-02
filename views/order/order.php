<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Оформление заказа';
/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form ActiveForm */
?>

<div class="section">
    <div class="container">
        <div class="order-order">
            <div class="row">
                <div class="col-md-8 col-lg-8">

                    <?php
                    $form = ActiveForm::begin([
                        'method' => 'post',
                        'action' => '/order/create-order'
                    ]);
                    ?>

                    <h3>Всего товаров в заказе на сумму: <?= $arrprice['totalprice_all'] ?> руб.</h3>

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
                    $form->field($model, 'delivery_type')->dropdownList([
                        1 => 'Доставка курьером',
                        2 => 'Доставка почтой'
                    ], ['prompt' => 'Выберите тип доставки',
                        'class' => 'delivery_type form-control' ]
                    );
                    ?>

                    <?= $form->field($model, 'name') ?>
                    <?= $form->field($model, 'phone') ?>
                    <?= $form->field($model, 'email') ?>
                    <?= $form->field($model, 'zipcode') ?>
                    <?= $form->field($model, 'city') ?>
                    <?= $form->field($model, 'street') ?>
                    <?= $form->field($model, 'house') ?>
                    <?= $form->field($model, 'build') ?>
                    <?= $form->field($model, 'room') ?>

                    <div class="form-group">
                        <?= Html::submitButton('Подтвердить', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

