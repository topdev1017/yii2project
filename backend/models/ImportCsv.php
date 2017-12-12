<?php 
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\ProductCategories;
use backend\models\ProductSizes;
use backend\models\Products;
use backend\models\Categories;
use backend\models\Specialized;
use backend\models\Manufactures;

class ImportCsv extends Model
{ 
    public $file;
    public $table;
    public $columns;

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
        return [
            'Products' => 'Products',
            'Categories' => 'Categories',
            'Specialized' => 'Specialized',
            'Manufactures' => 'Manufactures',
            'Sizes' => 'Sizes',
            'Finishes' => 'Finishes'
        ];
    }

    public function readExcelFile(){
        $inputFileName = Yii::getAlias('@root_name').'/resources/import_files/'.$this->file;
        require_once(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php'));
        //  Read your Excel workbook
        try {
            $inputFileType = \PHPExcel_IOFactory::identify($inputFileName);
            $objReader = \PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch(Exception $e) {
            die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        }
        return $objPHPExcel; 
    }

    public function getExcelSheetColumns(){
        require_once(Yii::getAlias('@vendor/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php'));
        $objPHPExcel = $this->readExcelFile();
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        //  Loop through each row of the worksheet in turn
        for ($row = 1; $row <= 1; $row++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);
            //  Insert row data array into your database of choice here
            //            print_r($rowData);
        }
        return $rowData[0];
    }

    public function do_import($objPHPExcel, $columns){
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        $total_imported = 0;
        $result['errors'] = '';
        $errors = [];
        //  Loop through each row of the worksheet in turn
        for ($row = 2; $row <= $highestRow; $row++){ 
            //            print_r('reading row '.$row.'<br >');
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                NULL,
                TRUE,
                FALSE);
            if($this->table == 'Products'){
                $products = Products::findOne($rowData[0][$columns['PID']]);
                if(!$products){
                    $products = new Products();

                    foreach($products->attributeLabels() as $key => $att){
                        if($key != 'created_at' && $key != 'updated_at'){
                            $products->$key = $rowData[0][$columns[$key]];
                        }

                    }  
                    if($products->validate() && $products->save()){
                        $total_imported++;
                        if(Products::isInLedCategory($products->PID)){
                            $products->led = 1;
                            $products->save(false); 
                        }

                        if(Products::isInQuickShipCategory($products->PID)){
                            $products->quick_ship = 1;
                            $products->save(false); 
                        }

                        foreach($columns['category'] as $cat_col){
                            if($rowData[0][$cat_col] != ''){
                                $prod_cat = new ProductCategories();
                                $prod_cat->PID = $products->PID;
                                $prod_cat->CID = $rowData[0][$cat_col];
                                $prod_cat->save(false); 
                            }
                        }
                    }else{
                        $errors[$row] = $products->errors;
                    }
                }            
            }elseif($this->table == 'Sizes'){
                $name = $rowData[0][$columns['name']]==''?'no size':$rowData[0][$columns['name']];
                $size = Sizes::find()->where('name like :threshold', [':threshold' =>$name])->one();
                if($size){
                    $product_sizes = new ProductSizes();
                    $product_sizes->PID = $rowData[0][$columns['product_id']];
                    $product_sizes->SID = $size->SID;
                    if($product_sizes->validate() && $product_sizes->save()){
                        $total_imported++;
                    }else{
                        $errors[$row] = $product_sizes->errors;
                    }
                }else{
                    $size = new Sizes();
                    $size->name = $name;
                    $size->save(false);

                    $product_sizes = new ProductSizes();
                    $product_sizes->PID = $rowData[0][$columns['product_id']];
                    $product_sizes->SID = $size->SID;
                    //                    $product_sizes->save(false);
                    if($product_sizes->validate() && $product_sizes->save()){
                        $total_imported++;
                    }else{
                        $errors[$row] = $product_sizes->errors;
                    }
                }
            }elseif($this->table == 'Finishes'){
                $size = Finishes::find()->where('name like :threshold', [':threshold' => $rowData[0][$columns['name']]])->one();
                if($size){
                    $product_sizes = new ProductFinishes();
                    $product_sizes->PID = $rowData[0][$columns['product_id']];
                    $product_sizes->FID = $size->FID;
                    $product_sizes->save(false);
                    $total_imported++;
                }else{


                    $size = new Finishes();
                    $size->name = $rowData[0][$columns['name']];
                    if($size->validate() && $size->save()){
                        $product_sizes = new ProductFinishes();
                        $product_sizes->PID = $rowData[0][$columns['product_id']];
                        $product_sizes->FID = $size->FID;
                        $product_sizes->save(false);
                        $total_imported++;
                    }else{
                        $errors[$row] = $size->errors;
                    }


                }
            }elseif($this->table == 'Categories'){
                $cat = Categories::findOne($rowData[0][$columns['CID']]);
                if(!$cat){
                    $cat = new Categories();

                    foreach($cat->attributeLabels() as $key => $att){
                        if($key != 'created_at' && $key != 'updated_at'){
                            $cat->$key = $rowData[0][$columns[$key]];
                        }

                    }    
                    if($rowData[0][$columns['keywords']] != ''){
                        $cat->addTagNames($rowData[0][$columns['keywords']]);
                    }

                    if($cat->validate() && $cat->save()){
                        $cat->setCategoryLastOrder();
                        $total_imported++;
                    }else{
                        $errors[$row] = $cat->errors;
                    }


                }

            }elseif($this->table == 'Specialized'){
                $cat = new Specialized();

                foreach($cat->attributeLabels() as $key => $att){
                    if($key != 'created_at' && $key != 'updated_at'){
                        $cat->$key = $rowData[0][$columns[$key]];
                    }
                }
                $cat->save(false);
                $total_imported++;

            }elseif($this->table == 'Manufactures'){
                $man = Manufactures::findOne($rowData[0][$columns['MID']]);
                if($man){
                    // to do update for manufacture?
                }else{
                    $man = new Manufactures(); 
                    foreach($man->attributeLabels() as $key => $att){
                        if($key != 'created_at' && $key != 'updated_at'){
                            $man->$key = $rowData[0][$columns[$key]];
                        }
                    }
                    if($rowData[0][$columns['keywords']] != ''){
                        $man->addTagNames($rowData[0][$columns['keywords']]);
                    }
                    if($man->validate() && $man->save()){
                        $man->save(false);
                        foreach($columns['category'] as $cat_col){
                            if($rowData[0][$cat_col] != ''){
                                $prod_cat = new ManufactureSpecialized();
                                $prod_cat->MID = $man->MID;
                                $prod_cat->SpID = $rowData[0][$cat_col];
                                $prod_cat->save(false); 
                            }
                        }
                        $total_imported++; 
                    }else{
                        $errors[$row] = $man->errors;
                    }


                }    
            }

        }
        $result['errors'] = $errors;
        $result['total_imported'] = $total_imported;
        return $result;
    }
}
?>