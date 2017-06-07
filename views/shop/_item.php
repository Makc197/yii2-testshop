<?php

use yii\helpers\Url;
use yii\helpers\Html;

$emptyimg = '/img/emptyimg.jpg';
$imgsrc = @$model->images[0]["img"];
//$var = condition ? exp1 : exp2;
$imgpath = isset($imgsrc) ? '/img/products/' . $imgsrc : $emptyimg;

$categoryid = yii::$app->request->get('category_id');
?>

<div class = "col-lg-4 col-md-6 col-sm-12">
    <!--Product -->
    <div class = "shop-item">

        <div class = "center-item">
            <!--Product Image -->
            <div class = "shop-item-image">
                <a href = "<?= Url::to(['/shop/page-product-details', 'product_id' => $model->id, 'category_id' => $categoryid]) ?>"><img src = "<?= $imgpath ?>" alt = "Item Name"></a>
            </div>
        </div>

        <!--Product Title -->
        <div class = "title">
            <h3><a href = "<?= Url::to(['/shop/page-product-details', 'product_id' => $model->id, 'category_id' => $categoryid]) ?>"><?= $model->title ?></a></h3>
        </div>

        <!--Product Price-->
        <div class = "price">
            <?= $model->price ?>
        </div>

        <!--Add to Cart Button -->
        <div class = "actions" id="<?= $model->id ?>">
            <!--<a href = "<= Url::to(['/shop/add-product-to-cart', 'product_id' => $model->id]) ?>" class = "btn btn-small"><i class = "icon-shopping-cart icon-white"></i> Добавить в корзину</a>-->
            <?=
            //По нажатии кнопки отрисовка модального окна через Bootstrap data-togle 
            //передаем ajax запросом через data-modal_url  product_id в /shop/modal - см base.js
            Html::a(
            '<i class = "icon-shopping-cart icon-white"></i> Добавить в корзину', "#", [
                'class' => 'btn  btn-primary',
                'data-toggle' => 'modal',
                'data-modal_url' => Url::to(
                ['/shop/modal', 'id' => $model->id]
                ),
                'data-target' => '#ModalWindow',
            ]
            );
            ?>
        </div>
        <!--End Product -->
    </div>
</div>
