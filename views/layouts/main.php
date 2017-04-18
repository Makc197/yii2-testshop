<?php

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>mPurpose - Multipurpose Feature Rich Bootstrap Template</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'>

        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/leaflet.ie.css" />
        <![endif]-->

        <script src="/theme/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Header Navigation & Logo-->
        <?= $this->render('header') ?>

        <!-- Page Title -->
        <div class="section section-breadcrumbs">
            <div class="row">
                <div class="container">
                    <div class="col-md-12">
                        <!--<h1><= Html::encode($this->title) ?></h1>-->
                        <h1><?= yii::$app->session->getFlash('regsuccess') == '' ? Html::encode($this->title) : yii::$app->session->getFlash('regsuccess') ?></h1>
                    </div>
                </div>
            </div>    
            <div class="row">
                <div class="container">
                    <?=
                    Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ])
                    ?>
                </div>
            </div>
        </div>

        <!-- Body -->
        <?= $content ?>

        <!-- Footer -->
        <?= $this->render('footer'); ?>

        <!-- Javascripts -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>

        <?php $this->endBody() ?>
    </body>

</html>
<?php $this->endPage() ?>