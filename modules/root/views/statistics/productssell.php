<?php

use yiier\chartjs\ChartJs;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = "Статистика по количеству проданных товаров";
//var_dump($category);
//var_dump($productsbycategory);
//die;
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card-box">
                    <?=
                    ChartJs::widget([
                        'type' => 'pie',
                        'options' => [
                            'barPercentage' => 1,
                            'height' => 1000,
                            'width' => 1000
                        ],
                        'data' => [
                            'labels' => $category,
                            'datasets' => [
                                    [
                                    'label' => 'Количество товаров',
                                    'data' => $productsbycategory,
                                    'backgroundColor' => [
                                        'rgba(255,99,132, 0.5)',
                                        'rgba(54,162,235, 0.5)',
                                        'rgba(255,206,86, 0.5)',
                                        'rgba(75,192,192, 0.5)',
                                        'rgba(55,99,132, 0.5)',
                                        'rgba(215,99,132, 0.5)',
                                        'rgba(155,99,132, 0.5)',
                                        'rgba(54,99,132, 0.5)',
                                    ],
                                ]
                            ]
                        ]
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

