<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class RateWebsiteAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/frontend_theme/resources';
    public $baseUrl = '@script_url/themes/frontend_theme/resources';
    public $sourcePath = '@app/themes/frontend_theme/resources';
    
    public $css = [
        'css/main.css',
//        'js/mcustomscrollbar/jquery.mCustomScrollbar.css',
        'css/responsive.css',
    ];
    public $js = [
//        '//assets.pinterest.com/js/pinit.js',
//        'js/jquery-1.11.2.min.js',
//        'js/init.js',
        
//        'js/mcustomscrollbar/jquery.mCustomScrollbar.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD,
        'type' => 'text/javascript'
    );
}
