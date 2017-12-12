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
class LineCardAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/frontend_theme/resources';
    public $baseUrl = '@script_url/themes/frontend_theme/resources';
    public $sourcePath = '@app/themes/frontend_theme/resources';
    
    public $css = [
        'css/line-card.css',
        'css/responsive.css',
    ];
    public $js = [
        'js/jquery-1.11.2.min.js',
        'js/line-card.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD,
        'type' => 'text/javascript'
    );
}
