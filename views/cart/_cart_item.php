<?php

use yii\helpers\Url;
use yii\helpers\Html;

$emptyimg = '/img/emptyimg.jpg';
$imgsrc = @$model->images[0]["img"];
$imgpath = isset($imgsrc) ? '/img/products/' . $imgsrc : $emptyimg;

$categoryid = yii::$app->request->get('category_id');
?>

<tr>
    <!-- Shopping Cart Item Image -->
    <td class="image"><a href = "<?= Url::to(['/shop/page-product-details', 'product_id' => $model->id, 'category_id' => $categoryid]) ?>"><img src = "<?= $imgpath ?>" alt = "<?= $model->title ?>"></a></td>
    <!-- Shopping Cart Item Description & Features -->
    <td>
        <div class="cart-item-title"><a href="<?= Url::to(['/shop/page-product-details', 'product_id' => $model->id]) ?>"><?= $model->title ?></a></div>
    </td>
    <!-- Shopping Cart Item Quantity -->
    <td class="quantity">
        <input class="cart-item-count form-control input-sm input-micro" id="<?= $model->id ?>" type="text" value="<?= $model->cartCount ?>">
    </td>
    <!-- Shopping Cart Item Price -->
    <td class="price"><?= $model->price ?></td>
    <!-- Shopping Cart Item Actions -->
    <td class="actions" id="<?= $model->id ?>">
        <a href="#" class="btn btn-xs btn-grey"><i class="remove-cart-item glyphicon glyphicon-trash"></i></a>
    </td>
</tr>
