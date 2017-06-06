<?php
use yii\helpers\Url;
use app\models\Category;
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav in" id="side-menu">

            <!--Поиск-->
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
            </li>

            <?php if (Yii::$app->user->can('admin')) : ?>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Администрирование<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?= Url::to('/root/product') ?>"> Товары</a></li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            <?php endif ?>

            <!--Каталог товаров-->
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Каталог товаров<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <?php
                    if ($categories = Category::getAllcategories()) {
                        foreach ($categories as $item) {
                            echo '<li><a href="' . Url::to(['/shop/page-products', 'category_id' => $item ["id"]]) . '">' . $item ["name"] . '</a></li>';
                        }
                    }
                    ?>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <!--Форма обратной связи-->
            <li>
                <a href="<?= Url::to('/site/contact') ?>"><i class="fa fa-edit fa-fw"></i> Форма обратной связи</a>
            </li>

            <!--Theme examples-->
            <li>
                <a href="#"><i class="fa fa-files-o fa-fw"></i> Theme examples<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?= Url::to('/site/page-portfolio-2-columns-1') ?>">Portfolio (2 Columns, Option 1)</a></li>
                    <li><a href="<?= Url::to('/site/page-portfolio-2-columns-2') ?>">Portfolio (2 Columns, Option 2)</a></li>
                    <li><a href="<?= Url::to('/site/page-portfolio-3-columns-1') ?>">Portfolio (3 Columns, Option 1)</a></li>
                    <li><a href="<?= Url::to('/site/page-portfolio-3-columns-2') ?>">Portfolio (3 Columns, Option 2)</a></li>
                    <li><a href="<?= Url::to('/site/page-job-details') ?>">Page job details</a></li>
                    <li><a href="<?= Url::to('/site/page-portfolio-item') ?>">Portfolio Item (Project) Description</a></li>
                    <li><a href="<?= Url::to('/site/page-products') ?>">Products catalog</a></li>
                    <li><a href="<?= Url::to('/site/page-shopping-cart') ?>">Shopping cart</a></li>
                </ul>
                <!-- /.nav-second-level -->
            </li>


            <!--<li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Second Level Item</a>
                    </li>
                    <li>
                        <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                            <li>
                                <a href="#">Third Level Item</a>
                            </li>
                        </ul>
                        /.nav-third-level 
                    </li>-->

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>