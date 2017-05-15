<?php

use \yii\helpers\Url;

$emptyimg = '/img/emptyimg.jpg';
$imgsrc = @$model->images[0]["img"];
//$var = condition ? exp1 : exp2;
$imgpath = isset($imgsrc) ? '/img/products/' . $imgsrc : $emptyimg;
?>

<div class = "col-md-4 col-sm-6">
    <!--Product -->
    <div class = "shop-item">

        <div class = "center-item">
            <!--Product Image -->
            <div class = "shop-item-image">
                <a href = "<?= Url::to(['/shop/page-product-details', 'id' => $model->id]) ?>"><img src = "<?= $imgpath ?>" alt = "Item Name"></a>
            </div>
        </div>

        <!--Product Title -->
        <div class = "title">
            <h3><a href = "<?= Url::to(['/shop/page-product-details', 'id' => $model->id]) ?>"><?= $model->title ?></a></h3>
        </div>

        <!--Product Price-->
        <div class = "price">
            <?= $model->price ?>
        </div>

        <!--Add to Cart Button -->
        <div class = "actions">
            <a href = "page-product-details" class = "btn btn-small"><i class = "icon-shopping-cart icon-white"></i> Добавить в корзину</a>
        </div>

        <!--End Product -->
    </div>
</div>
