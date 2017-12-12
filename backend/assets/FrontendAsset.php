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
class FrontendAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/frondsatend_theme/resources';
    public $baseUrl = '@script_url/themes/frontend_theme/resources';
    public $sourcePath = '@app/thesdames/frontend_theme/resources';
    
    public $css = [
        'css/main.css',
        'js/mcustomscrollbar/jquery.mCustomScrollbar.css',
        
        'js/jquery.bxslider/jquery.bxslider.css',
        'js/jquery-qtip/jquery.qtip.css',
        'css/sliders.css'
    ];
    public $js = [
        '//assets.pinterest.com/js/pinit.js',
        'js/jquery-1.11.2.min.js',
        'js/history/history.js',
        'js/init.js',
        
        'js/mcustomscrollbar/jquery.mCustomScrollbar.js',
        
        'js/jquery-qtip/jquery.qtip.js',
        'js/jquery.bxslider/jquery.bxslider.js',
        
        'http://a.vimeocdn.com/js/froogaloop2.min.js',
        'http://www.youtube.com/player_api',
        
        'js/sliders/slider_video_full_width.js',
        'js/sliders/slider_thumb_caption.js',
        'js/sliders/slider_simple_image_thumbs.js'
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
