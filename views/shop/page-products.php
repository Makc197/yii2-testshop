<?php

use yii\widgets\ListView;

$this->title = 'Каталог товаров. Категория ' . $category->name;
?>

<div class="eshop-section section">
    <div class="container">
        <!--<div class="row">-->
            <?=
            ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_item',
                'pager' => [
                    'options' => ['class' => 'pagination pagination-lg'],
                    'nextPageLabel' => 'Вперед',
                    'prevPageLabel' => 'Назад'
                ],
                'layout' => '{summary}{items}<div class="pagination-wrapper">{pager}</div>',
//                'layout' => '{summary}<div class="row">{items}</div><div class="pagination-wrapper">{pager}</div>',
            ]);
            ?>
        <!--</div>-->
    </div>
</div>