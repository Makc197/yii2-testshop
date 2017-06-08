<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

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

                    <?php
                    var_dump($arrprice);
                    ?>

                    <h4>Купленные товары:</h4>
                    <table border = "1" cellpadding = "5" cellspacing = "0" width = "90%">
                        <tr>
                            <th>N п/п</th>
                            <th>Наименование</th>
                            <th>Артикул</th>
                            <th>Цена</th>
                            <th>Количество</th>
                            <th>Сумма</th>
                        </tr>
                        <?php
                        $i = 1;
                        $sum = 0;
                        foreach ($arrprice['cart'] as $key => $val) {
                            ?>
                            <tr> 
                                <td><?= $i++ ?></td>
                                <td><?= $val['title'] ?></td>
                                <td><?= str_pad($key, 8, "0", STR_PAD_LEFT) ?></td>
                                <td><?= $val['price'] ?></td>
                                <td><?= $val['count'] ?></td>
                                <td><?= $val['totalprice_product'] ?></td>
                            </tr>
                            <?
                            $sum += $item['price'] * $item['quantity'];
                            }
                            ?>
                        </table>
                        <p>Всего товаров в заказе на сумму: <?= $arrprice['totalprice_all'] ?> руб.</p>

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
                                    'label' => 'Наименование'],
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
                        ], ['prompt' => 'Выберите тип доставки']
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

