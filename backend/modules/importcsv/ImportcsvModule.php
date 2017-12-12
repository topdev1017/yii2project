<?php

namespace backend\modules\importcsv;

use yii;

class ImportcsvModule extends yii\base\Module
{
    public $controllerNamespace = 'backend\modules\importcsv\controllers';

    public function init()
    {
        parent::init();
    }
    
    public function getTables() {
        return [
            'Products',
            'Manufactures',
            'Sizes',
            'Tags',
        ];
    }
}
