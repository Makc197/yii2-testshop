<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = ['label' => 'Администрирование', 'url' => ['/root/product']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="section">
    <div class="container">
        <div class="product-index">

            <!--<h1><= Html::encode($this->title) ?></h1>-->
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

            <p>
                <?= Html::a('Создать запись в базе', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'title',
                    'description:ntext',
                    'price',
                    'sale',
                    // 'count',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
        </div>
    </div>
</div>