<?php

use yii\widgets\ListView;
use yii\helpers\Url;

$this->title = 'Корзина';
?>

<div class="section">
    <div class="container">

        <span id="result_div_id1">
            <?php
            $session = Yii::$app->session;
//          var_dump($session['cart']);
            ?>
        </span>


        <div class="row">
            <div class="col-md-8">
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="#" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> Обновить</a>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> Оформить покупку</a>
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

                    <tr>
                        <td class="image"><a href="<?= Url::to('/site/page-product-details') ?>"><img src="/img/product2.jpg" alt="Item Name"></a></td>
                        <td>
                            <div class="cart-item-title"><a href="<?= Url::to('/site/page-product-details') ?>">LOREM IPSUM DOLOR</a></div>
                            <div class="feature color">
                                Color: <span class="color-orange"></span>
                            </div>
                            <div class="feature">Size: <b>XXL</b></div>
                        </td>
                        <td class="quantity">
                            <input class="form-control input-sm input-micro" type="text" value="1">
                        </td>
                        <td class="price">$999.99</td>
                        <td class="actions">
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>

                    <tr>
                        <td class="image"><a href="<?= Url::to('/site/page-product-details') ?>"><img src="/img/product3.jpg" alt="Item Name"></a></td>
                        <td>
                            <div class="cart-item-title"><a href="<?= Url::to('/site/page-product-details') ?>">LOREM IPSUM DOLOR</a></div>
                            <div class="feature color">
                            </div>
                            <div class="feature">Size: <b>XXL</b></div>
                        </td>
                        <td class="quantity">
                            <input class="form-control input-sm input-micro" type="text" value="1">
                        </td>
                        <td class="price">$999.99</td>
                        <td class="actions">
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>


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
                        <td><b>Скидка</b></td>
                        <td>- $18.00</td>
                    </tr>
                    <tr class="cart-grand-total">
                        <td><b>Итого</b></td>
                        <td><b>$163.55</b></td>
                    </tr>
                </table>
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="#" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> Обновить</a>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> Оформить покупку</a>
                </div>
            </div>
        </div>
    </div>
</div>