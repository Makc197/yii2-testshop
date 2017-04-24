<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/root/product']];
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section">
    <div class="container">
        <div class="product-view">

            <!--<h1><= Html::encode($this->title) ?></h1>-->

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
                    'description:ntext',
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
