<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PublicAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'style/css/bootstrap.min.css',
        'style/css/font-awesome.min.css',
        'style/css/animate.min.css',
        'style/css/owl.carousel.css',
        'style/css/owl.theme.css',
        'style/css/owl.transitions.css',
        'style/css/style.css',
        'style/css/responsive.css',
    ];
    public $js = [
//        'style/js/jquery-1.11.3.min.js',
        'style/js/bootstrap.min.js',
        'style/js/owl.carousel.min.js',
        'style/js/jquery.stickit.min.js',
        'style/js/menu.js',
        'style/js/scripts.js'
    ];
    public $depends = [

    ];
}
