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
class SortableAsset extends AssetBundle
{
    public $basePath = '@webroot/../../themes/backend_theme/files';
    public $baseUrl = '@script_url/themes/backend_theme/files';
    public $sourcePath = '@app/themes/backend_theme/files';
    
    public $css = [
        'css/sortable.css',
    ];
    public $js = [
        'js/nestedsortable/jquery.mjs.nestedSortable.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\jui\JuiAsset',
//        'yii\bootstrap\BootstrapAsset',
    ];
    
    public $jsOptions = array(
        'position' => \yii\web\View::POS_HEAD,
        'type' => 'text/javascript'
    );
}
