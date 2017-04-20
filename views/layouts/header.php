<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<!-- Navigation & Logo-->
<div class="navbar navbar-default" role="navigation">
    <div class="container">
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

                <!--<li><a href="<= Url::to('/') ?>">Главная</a></li>--> 

                <!--<li class="active">
                    <a href="/">
                        <span class="glyphicon glyphicon-home"></span>
                    </a>
                </li>-->

                <?php if (Yii::$app->user->can('admin')) : ?>
                    <li class="dropdown"><a href="#"class="dropdown-toggle" data-toggle="dropdown">Администрирование<b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?= Url::to('/root/product') ?>">Товары (добавление/редактирование)</a></li>
                        </ul>                              
                    </li>    
                <?php endif ?>

                <li class="dropdown"><a href="#"class="dropdown-toggle" data-toggle="dropdown">Theme examples<b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <li><a href="<?= Url::to('/site/page-portfolio-2-columns-1') ?>">Portfolio (2 Columns, Option 1)</a></li>
                        <li><a href="<?= Url::to('/site/page-portfolio-2-columns-2') ?>">Portfolio (2 Columns, Option 2)</a></li>
                        <li><a href="<?= Url::to('/site/page-portfolio-3-columns-1') ?>">Portfolio (3 Columns, Option 1)</a></li>
                        <li><a href="<?= Url::to('/site/page-portfolio-3-columns-2') ?>">Portfolio (3 Columns, Option 2)</a></li>
                        <li><a href="<?= Url::to('/site/page-portfolio-item') ?>">Portfolio Item (Project) Description</a></li>

                        <li class="divider"></li>
                        <li><a href="#">Отдельная ссылка</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Еще одна отдельная ссылка</a></li>
                    </ul>
                </li>

                <li class="dropdown"><a href="#"class="dropdown-toggle" data-toggle="dropdown">Каталог товаров<b class="caret"></b></a>
                    <ul class="dropdown-menu">

                        <li><a href="<?= Url::to('/site/page-products') ?>">Категория 1</a></li>
                        <li><a href="<?= Url::to('/site/page-products') ?>">Категория 2</a></li>
                        <li><a href="<?= Url::to('/site/page-products') ?>">Категория 3</a></li>
                        <li><a href="<?= Url::to('/site/page-products') ?>">Категория 4</a></li>

                        <li class="divider"></li>
                        <li><a href="#">Отдельная ссылка</a></li>
                    </ul>
                </li>

                <li>
                    <a href="<?= Url::to('/site/about') ?>">О нас</a>
                </li>

                <li>
                    <a href="<?= Url::to('/site/contact') ?>">Форма обратной связи</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
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
                    <a href="<?= Url::to('/shop/page-shopping-cart') ?>">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <?= '(100 руб)' ?>
                    </a>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>