<?php

use yii\helpers\Url;
use yii\helpers\Html;
?>

<!-- Navigation & Logo-->
<div class="mainmenu-wrapper">
    <div class="container">
        <div class="menuextras">
            <div class="extras">
                <ul>
                    <li class="shopping-cart-items"><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="<?= Url::to('/shop/page-shopping-cart')?>"><b><?='0 товаров'?></b></a></li>

                    <li>
                        <?= Html::beginForm(['/site/logout'], 'post') ?>
                        <?=
                        Yii::$app->user->isGuest ?
                        Html::a('Вход', '/site/login') :
                        Html::submitButton(
                        sprintf('Выход (%s)', Yii::$app->user->identity->login), ['class' => 'btn-link logout maks-logout']
                        );
                        ?>
                        <?= Html::endForm() ?>
                    </li>

                </ul>
            </div>
        </div>
        <nav id="mainmenu" class="mainmenu">
            <ul>
                <li class="logo-wrapper"><a href="<?= Url::to('/site/index') ?>"><img src="/img/mPurpose-logo.png" alt="Multipurpose Twitter Bootstrap Template"></a></li>
                <li class="active">
                    <a href="<?= Url::to('/site/index') ?>">
                        <span class="glyphicon glyphicon-home" style="font-size: 20px;"></span>
                    </a>
                </li>
                <li class="has-submenu">
                    <a href="#">Каталог товаров</a>
                    <div class="mainmenu-submenu">
                        <div class="mainmenu-submenu-inner"> 
                            <div>
                                <h4>Категории товаров</h4>
                                <ul>
                                    <li><a href="<?= Url::to('/site/page-products') ?>">Категория 1</a></li>
                                    <li><a href="<?= Url::to('/site/page-products') ?>">Категория 2</a></li>
                                    <li><a href="<?= Url::to('/site/page-products') ?>">Категория 3</a></li>
                                    <li><a href="<?= Url::to('/site/page-products') ?>">Категория 4</a></li>

                                </ul>                              
                            </div>
                            <div>
                                <h4>Theme examples</h4>
                                <ul>
                                    <li><a href="<?= Url::to('/site/page-portfolio-2-columns-1') ?>">Portfolio (2 Columns, Option 1)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-2-columns-2') ?>">Portfolio (2 Columns, Option 2)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-3-columns-1') ?>">Portfolio (3 Columns, Option 1)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-3-columns-2') ?>">Portfolio (3 Columns, Option 2)</a></li>
                                    <li><a href="<?= Url::to('/site/page-portfolio-item') ?>">Portfolio Item (Project) Description</a></li>
                                </ul>                             
                            </div>                         
                        </div><!-- /mainmenu-submenu-inner -->
                    </div><!-- /mainmenu-submenu -->
                </li>
                <li>
                    <a href="<?= Url::to('/site/about') ?>">О нас</a>
                </li>
                <li>
                    <a href="<?= Url::to('/site/contact') ?>">Форма обратной связи</a>
                </li>
            </ul>
        </nav>
    </div>
</div>