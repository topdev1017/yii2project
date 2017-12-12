<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "specialized".
 */
class Specialized extends \backend\models\base\Specialized
{
    public function createSpecializedTree() {
        $models = Specialized::find()->where(['status'=>1])->orderBy("name ASC")->all();
        $html = '';
        if($models) {
            $html .= '<li>';
            $html .= '<h3>Specialized</h3>';
            $html .= '<ul>';
            foreach($models as $model) {
                $html .= '<li>';
                if(Yii::$app->controller->id == "specialized") {
                    $html .= '<a href="'.Yii::$app->UrlManager->createUrl("specialized/index").'#spec_'.$model->SpID.'" class="scroll-top" data-target=".spec_'.$model->SpID.'">'.$model->name.'</a>';
                } else {
                    $html .= '<a href="'.Yii::$app->UrlManager->createUrl("specialized/index").'#spec_'.$model->SpID.'" class="" data-target=".spec_'.$model->SpID.'">'.$model->name.'</a>';
                }
                
                $html .= '</li>';
            }
            $html .= '</ul>';
            $html .= '</li>';
        }
        return $html;
    }
}
