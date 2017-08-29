<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title . ' (Арт.: ' . str_pad($model->id, 8, "0", STR_PAD_LEFT) . ')';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/root/product']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$path = Yii::getAlias('@web/img/products/');
$emptyimg = '@web/img/emptyimg.jpg';
?>

<div class="section">
    <div class="container">
        <div class="row">
            <!-- Product Image & Available Colors -->
            <div class="col-lg-4 col-md-6 col-sm-6">
                <!--<div class="product-image-large">-->
                <div class="form-group">
                    <div class="owl-theme owl-carousel">
                        <?php if ($model->images): ?>
                            <?php foreach ($model->images as $image) : ?>
                            <div class="item">
                                <?= Html::img($path . $image->img, []) ?>
                            </div>
                        <?php endforeach ?>
                        <?php else: ?>
                            <?= Html::img($emptyimg, []) ?>
                        <?php endif; ?>   
                    </div>
                </div>
                <!--</div>-->             
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 product-details">
                <p>
                    <?= Html::a('Внести изменения', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('Удалить', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
                </p>

                <h4><?= $this->title ?></h4>

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
                        <td><b>Остаток (шт): </b></td>
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
            <div class="col-lg-10">
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