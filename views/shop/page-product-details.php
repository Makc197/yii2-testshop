<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Modal;
use app\models\Category;

$this->title = 'Product details';

$path = Yii::getAlias('@web/img/products/');
$categoryid = yii::$app->request->get('category_id');
$categoryname = Category::findOne($categoryid)->name;

$this->title = $model->title . ' (Арт.: ' . str_pad($model->id, 8, "0", STR_PAD_LEFT) . ')';
$this->params['breadcrumbs'][] = ['label' => $categoryname, 'url' => ['/shop/page-products', 'category_id' => $categoryid]];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section">
    <div class="container">
        <div class="row">
            <!-- Product Image & Available Colors -->
            <div class="col-lg-4 col-md-5 col-sm-6">
                <!--<div class="product-image-large">-->
                <div class="form-group">
                    <div class="owl-theme owl-carousel">
                        <?php foreach ($model->images as $image) : ?>
                            <div class="item">
                                <?= Html::img($path . $image->img, []) ?>
                            </div>
                        <?php endforeach ?>
                    </div>
                </div>
                <!--</div>-->             
            </div>

            <div class="col-lg-3 col-md-5 col-sm-6 product-details">
                <!--Add to Cart Button -->

                <!-- Здесь синхронный запрос при нажатии кнопки - передаем в контроллер product_id -->
                <!--<div class = "actions add-to-cart" id="<= $model->id ?>">-->
                    <!--<a href = "<= Url::to(['/shop/add-product-to-cart', 'product_id' => $model->id]) ?>" class = "btn btn-small"><i class = "icon-shopping-cart icon-white"></i> Добавить в корзину</a>-->
                <!--</div>-->

                <!-- Здесь ajax запрос при нажатии кнопки - см base.js -->
                <!--<div class = "actions add-to-cart" id="<= $model->id ?>">-->
                    <!--<a class = "btn btn-small"><i class = "icon-shopping-cart icon-white"></i> Добавить в корзину</a>-->
                <!--</div>-->

                <?=
                //По нажатии кнопки отрисовка модального окна через Bootstrap data-togle 
                //передаем ajax запросом через data-modal_url  product_id в /shop/modal - см base.js
                Html::button(
                '<span class="fa fa-pencil">Добавить в корзину</span>', [
                    'class' => 'btn  btn-primary',
                    'data-toggle' => 'modal',
                    'data-modal_url' => Url::to(
                    ['/shop/modal', 'id' => $model->id]
                    ),
                    'data-target' => '#ModalWindow',
                ]
                );
                ?>

                </br>
                <span id="result_div_id1">
                    <?php
                    $session = Yii::$app->session;
                    var_dump($session['cart']);
                    ?>
                </span>

                <h4>
                    </br>
                </h4>

                <!--<h4><= $this->title ?></h4>-->

                <table class="shop-item-selections">

                    <tr>
                        <td><b>Цена: </b></td>
                        <td>
                            <div class="price">
                                <span class="price-was"><?= $model->price ?></span> <?= $model->sale ?>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Осталось: </b></td>
                        <td>
                            <?= $model->count ?>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Категория: </b></td>
                        <td>
                            <?php
                            $categories = [];
                            foreach ($model->categories as $category) {
                                $categories[] = $category->name;
                            }
                            echo implode('<br>', $categories);
                            ?>
                        </td>
                    </tr>

                </table>
            </div>
            <!-- End Product Summary & Options -->
        </div>

        <div class="row">
            <!-- Full Description & Specification -->
            <div class="col-lg-7 col-md-10">
                <div class="tabbable">
                    <!-- Tabs -->
                    <ul class="nav nav-tabs product-details-nav">
                        <li class="active"><a href="#tab1" data-toggle="tab">Описание</a></li>
                        <li><a href="#tab2" data-toggle="tab">Доп. информация по товару</a></li>
                    </ul>
                    <!-- Tab Content (Full Description) -->
                    <div class="tab-content product-detail-info">
                        <div class="tab-pane active" id="tab1">
                            <?= $model->description ?>
                        </div>
                        <!-- Tab Content (Specification) -->
                        <div class="tab-pane" id="tab2">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'title',
                                        [
                                        'label' => 'Категория',
                                        'format' => 'raw',
                                        'value' => function($data) {
                                            $categories = [];
                                            foreach ($data->categories as $category) {
                                                $categories[] = $category->name;
                                            }
                                            return implode('<br>', $categories);
                                        }
                                    ],
                                    'price',
                                    'sale',
                                    'id',
                                    'count',
                                ],
                            ])
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Full Description & Specification -->
        </div>
    </div>
</div>
<?php
Modal::begin(
[
    'id' => 'ModalWindow',
    'size' => Modal::SIZE_SMALL,
]
);
Modal::end();
?>