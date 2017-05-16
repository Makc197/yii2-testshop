<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/css/site.css',
        '/theme/css/bootstrap.min.css',
        '/theme/css/icomoon-social.css',
        '/theme/css/leaflet.css',
        '/theme/css/main.css',
        '/theme/plugins/owlcarousel/dist/assets/owl.carousel.min.css',
        '/theme/plugins/owlcarousel/dist/assets/owl.theme.default.min.css',
        '/theme/plugins/custombox/dist/custombox.min.css',
        '/css/fonts.css',
    ];
    public $js = [
        '/js/base.js',
//      '/theme/js/bootstrap.min.js',
        '/theme/js/jquery.fitvids.js',
        '/theme/js/jquery.sequence-min.js',
        '/theme/js/jquery.bxslider.js',
        '/theme/js/main-menu.js',
        '/theme/js/template.js',
        '/theme/js/modernizr-2.6.2-respond-1.1.0.min.js',
        '/theme/plugins/owlcarousel/dist/owl.carousel.min.js',
        '/theme/plugins/owlcarousel/dist/owl.carousel.js',
        '/theme/plugins/custombox/dist/custombox.min.js',
        '/js/leaflet.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}
