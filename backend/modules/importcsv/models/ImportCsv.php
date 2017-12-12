<?php 
namespace backend\modules\importcsv\models;

use Yii;
use yii\base\Model;

class ImportCsv extends Model
{ 
    public $file;
    public $table;
    
    public function rules()
    {
        return [
            [['file','table'], 'required'],
            [['file','table'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'file' => 'File',
            'table' => 'Table',
        ];
    }
    
    public function getTables() {
        echo "<pre>";
        print_r($this);
        echo "<pre>";
        die();
    }
}
?>