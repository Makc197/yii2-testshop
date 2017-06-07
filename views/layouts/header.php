<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Cart;
?>

<div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?= Url::to('/') ?>">МаГаЗиН</a>
</div>
<div class="collapse navbar-collapse">

    <ul class="nav navbar-nav navbar-left">

        <li>
            <a href="<?= Url::to('/site/about') ?>">О нас</a>
        </li>

        <li>
            <a href="<?= Url::to('/site/contacts') ?>">Контакты</a>
        </li>

        <li>
            <a href="<?= Url::to('/site/contact') ?>">Форма обратной связи</a>
        </li>

    </ul>

    <ul class="nav navbar-nav navbar-right">

        <li>
            <a href="<?= Url::to('/cart/page-shopping-cart') ?>"><span>Корзина</span>
                <span class="cart-total-price glyphicon glyphicon-shopping-cart"><?php
                    if ($arrprice = Cart::recalcpricearr(Yii::$app->session['cart'])) {
                        echo $arrprice['totalprice_all'];
                    }
                    ?></span>
            </a>
        </li>


        <!--<li>
            <?
            Yii::$app->user->isGuest ?
            Html::a('Вход', Url::to('/site/login')) :
            Html::a(sprintf('Выход (%s)', Yii::$app->user->identity->login), Url::to('/site/logout'));
            ?>
        </li>-->

        <li>
            <!--logout - перехватываем событие js - см \js\base.js-->
            <?= Html::beginForm(['/site/logout'], 'post', ['id' => 'logout_form']) ?>
            <?= Html::endForm() ?>
            <?=
            Yii::$app->user->isGuest ? Html::a('Вход', Url::to('/site/login')) :
            Html::a(sprintf('Выход (%s)', Yii::$app->user->identity->login), '#', ['class' => 'logout_link'])
            ?>
        </li>

        <li>
            <span class="header-spacer">
        </li>

    </ul>

</div>