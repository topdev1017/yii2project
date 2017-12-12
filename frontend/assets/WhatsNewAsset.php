<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;
use yii\web\View;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class WhatsNewAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/frontend_theme/resources';
    public $baseUrl = '@script_url/themes/frontend_theme/resources';
    public $sourcePath = '@app/themes/frontend_theme/resources';
    
    public $css = [
        'css/main.css',
        'css/whats-new.css',
        'css/responsive.css',
        
        'js/jquery.bxslider/jquery.bxslider.css',
        'js/jquery-qtip/jquery.qtip.css',
    ];
    public $js = [
        'js/jquery-1.11.2.min.js',
        'js/jquery.bxslider/jquery.bxslider.min.js',
        'js/jquery-qtip/jquery.qtip.js',
        'http://a.vimeocdn.com/js/froogaloop2.min.js',
        'http://www.youtube.com/player_api',
        'js/init.js',
        'js/whats_new.js',
        'js/luminaire-selector.js',
    ];
    
    public $depends = [
//        'frontend\assets\AppAsset',
    ];
    
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD,
        'type' => 'text/javascript'
    );
}
