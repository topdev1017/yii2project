<?php

namespace backend\models\base;

use Yii;

/**
 * This is the base-model class for table "product_categories".
 *
 * @property integer $PCID
 * @property integer $PID
 * @property integer $CID
 */
class ProductCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['PID', 'CID'], 'required'],
            [['PID', 'CID'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'PCID' => 'Pcid',
            'PID' => 'Pid',
            'CID' => 'Cid',
        ];
    }
}
