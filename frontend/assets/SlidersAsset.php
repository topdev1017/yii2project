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
class SlidersAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/frontend_theme/resources';
    public $baseUrl = '@script_url/themes/frontend_theme/resources';
    public $sourcePath = '@app/themes/frontend_theme/resources';
    public $slider;
    
    public $css = [
        'js/jquery.bxslider/jquery.bxslider.css',
        'js/jquery-qtip/jquery.qtip.css',
        'js/revolution-slider/css/settings.css',
        'css/sliders.css',
    ];
    public $js = [
        'js/jquery-1.11.2.min.js',
        'js/jquery-qtip/jquery.qtip.js',
        'js/jquery.bxslider/jquery.bxslider.js',
        
        'js/revolution-slider/js/jquery.themepunch.tools.min.js',
        'js/revolution-slider/js/jquery.themepunch.revolution.min.js',
        'js/revolution-slider/js/jquery.themepunch.enablelog.js',
        'http://cdn.jsdelivr.net/jquery.velocity/0.9.0/jquery.velocity.min.js',
        
        'http://a.vimeocdn.com/js/froogaloop2.min.js',
        'http://www.youtube.com/player_api',
        
        'js/sliders/slider_video_full_width.js',
        'js/sliders/slider_thumb_caption.js',
        'js/sliders/slider_simple_image_thumbs.js',
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
