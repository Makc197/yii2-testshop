<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use stalkerrr\yandex_map\YandexMapWidget;
use stalkerrr\yandex_map\YandexPreset;
use stalkerrr\yandex_map\YandexMapCluster;

$this->title = 'Контакты';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="section">
    <div class="container">

        <p>
            Контакты...
            </br>
            Адрес...
            </br>
            Карта...
            <?php
            $testPreset = new YandexPreset();
            $testPreset->type = YandexPreset::TYPE_SIMPLE;
            $testPreset->color = YandexPreset::COLOR_GREEN;
            $testPreset->circle = true;

            $widget = YandexMapWidget::begin(
            ['points' => [
                        ['coord' => [53.21, 32.34], 'content' => [], 'opts' => ['preset' => $testPreset]],
//                        ['coord' => [54.21, 30.34]]
                ], 'zoomValue' => 7
            ]
            );

            $cluster = new YandexMapCluster();
            $cluster->preset = $testPreset;

            $testPreset->color = YandexPreset::COLOR_BLACK;
            $widget->addCluster(
            [
                    ['coord' => [43.21, 31.34], 'content' => [], 'opts' => ['preset' => $testPreset]],
                    ['coord' => [45.31, 31.34]]
            ], $cluster
            );


//            $widget->addCollection([['coord' => [32.25, 21.54]], ['coord' => [40.21, 39.14]]], $testPreset);

            YandexMapWidget::end();
            ?>
        </p>

    </div>
</div>
