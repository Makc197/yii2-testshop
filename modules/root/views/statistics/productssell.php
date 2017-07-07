<?php

use yiier\chartjs\ChartJs;
use yii\widgets\Pjax;
use yii\widgets\ListView;

$this->title = "Статистика по проданным товарам"
?>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="card-box">
                    <?=
                    ChartJs::widget([
                        'type' => 'line',
                        'options' => [
                            'height' => 200,
                            'width' => 600
                        ],
                        'data' => [
                            'labels' => ["January", "February", "March", "April", "May", "June", "July"],
                            'datasets' => [
                                    [
                                    'label' => '# of Votes',
                                    'data' => [65, 59, 90, 81, 56, 55, 40]
                                ],
                                    [
                                    'label' => '# of Votes',
                                    'data' => [28, 48, 40, 19, 96, 27, 100]
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

