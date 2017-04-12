<?php

use yii\helpers\Url;

$this->title = 'Корзина';
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Action Buttons -->
                <div class="pull-right">
                    <a href="#" class="btn btn-grey"><i class="glyphicon glyphicon-refresh"></i> Обновить</a>
                    <a href="#" class="btn"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> Оформить покупку</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Shopping Cart Items -->
                <table class="shopping-cart">
                    <!-- Shopping Cart Item -->
                    <tr>
                        <!-- Shopping Cart Item Image -->
                        <td class="image"><a href="page-product-details.html"><img src="/img/product1.jpg" alt="Item Name"></a></td>
                        <!-- Shopping Cart Item Description & Features -->
                        <td>
                            <div class="cart-item-title"><a href="page-product-details.html">LOREM IPSUM DOLOR</a></div>
                            <div class="feature color">
                                Color: <span class="color-white"></span>
                            </div>
                            <div class="feature">Size: <b>XXL</b></div>
                        </td>
                        <!-- Shopping Cart Item Quantity -->
                        <td class="quantity">
                            <input class="form-control input-sm input-micro" type="text" value="1">
                        </td>
                        <!-- Shopping Cart Item Price -->
                        <td class="price">$999.99</td>
                        <!-- Shopping Cart Item Actions -->
                        <td class="actions">
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-pencil"></i></a>
                            <a href="#" class="btn btn-xs btn-grey"><i class="glyphicon glyphicon-trash"></i></a>
                        </td>
                    </tr>
                    <!-- End Shopping Cart Item -->
                    <tr>
                        <td class="image"><a href="page-product-details.html"><img src="/img/product2.jpg" alt="Item Name"></a></td>
                        <td>
                            <div class="cart-item-title"><a href="page-product-details.html">LOREM IPSUM DOLOR</a></div>
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
                        <td class="image"><a href="page-product-details.html"><img src="/img/product3.jpg" alt="Item Name"></a></td>
                        <td>
                            <div class="cart-item-title"><a href="page-product-details.html">LOREM IPSUM DOLOR</a></div>
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
          
            <div class="col-md-4  col-md-offset-0 col-sm-6 col-sm-offset-6">
                
            </div>
            
            <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-6">
                
            </div>

            <!-- Shopping Cart Totals -->
            <div class="col-md-4 col-md-offset-0 col-sm-6 col-sm-offset-6">
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