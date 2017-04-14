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
        'theme/css/bootstrap.min.css',
        'theme/css/icomoon-social.css',
        'theme/css/leaflet.css',
        'theme/css/main.css',
        'css/site.css',
        'theme/plugins/custombox/dist/custombox.min.css'
    ];
    public $js = [
        'theme/js/bootstrap.min.js',
        'theme/js/jquery.fitvids.js',
        'theme/js/jquery.sequence-min.js',
        'theme/js/jquery.bxslider.js',
        'theme/js/main-menu.js',
        'theme/js/template.js',
        'theme/plugins/custombox/dist/custombox.min.js'
    ];
    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];

}
