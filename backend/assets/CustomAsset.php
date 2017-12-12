<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class CustomAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/backend_theme/resources';
    public $baseUrl = '@web/../../themes/backend_theme/resources';
    public $sourcePath = '@app/themes/backend_theme/resources';
    
    public $css = [
        'css/theme_styles.css',
    ];
    //public $js = [
//        'js/jquery-1.11.2.min.js',
//        'js/init.js',
//    ];
    public $depends = [
        'backend\assets\AppAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD,
        'type' => 'text/javascript'
    );
}
