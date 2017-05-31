<?php

use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'Корзина';
?>

<div class="section">
    <div class="container">

        <div class="row">
            <div class="col-md-8">
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="<?= Url::to('/cart/page-shopping-cart') ?>" class="recalc-total-price btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> Пересчитать</a>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> Оформить покупку</a>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="pull-right">
                    <span id="result_div_id1">
                    </span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <!-- Shopping Cart Items -->
                <table class="shopping-cart">
                    <!-- Shopping Cart Item -->
                    <?=
                    ListView::widget([
                        'dataProvider' => $dataProvider,
                        'itemView' => '_cart_item',
                        'pager' => [
                            'options' => ['class' => 'pagination pagination-lg'],
                            'nextPageLabel' => 'Вперед',
                            'prevPageLabel' => 'Назад'
                        ],
                        'layout' => '{summary}<div class="row">{items}</div><div class="pagination-wrapper">{pager}</div>',
                    ]);
                    ?>
                    <!-- End Shopping Cart Item -->
                </table>
                <!-- End Shopping Cart Items -->
            </div>
        </div>

        <div class="row">
            <!-- Shopping Cart Totals -->
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-6">
                <table class="cart-totals">
                    <tr>
                    </tr>
                    <tr>
<!--                    <td><b>Скидка</b></td>
                        <td>- $18.00</td>-->
                    </tr>
                    <tr class="cart-grand-total">
                        <td><b>Итого</b></td>
                        <td><b><span id="total-price"><?= $arrprice['totalprice_all'] ?></span></b></td>
                    </tr>
                </table>
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="<?= Url::to('/cart/page-shopping-cart') ?>" class="recalc-total-price btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> Пересчитать</a>
                    <a href="#" class="btn"><i class="recalc-total-price glyphicon glyphicon-shopping-cart icon-white"></i> Оформить покупку</a>
                </div>
            </div>
        </div>
    </div>
</div>