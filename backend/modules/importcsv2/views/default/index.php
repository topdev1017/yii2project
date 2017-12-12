<?php
/**
 * ImportCSV Module
 *
 * @author Artem Demchenkov <lunoxot@mail.ru>
 * @version 0.0.3
 *
 * module form
 */
define("Import","Import");
/*$this->breadcrumbs=array(
	Import." CSV",
);*/

use yii\helpers\Html;
?>
<div id="importCsvSteps">
    <h1><?php echo Import ?> CSV</h1>

    <strong> File :</strong> <span id="importCsvForFile">&nbsp;</span><br/>
    <strong> Fields Delimiter  :</strong> <span id="importCsvForDelimiter">&nbsp;</span><br/>
    <strong> Text Delimiter :</strong> <span id="importCsvForTextDelimiter">&nbsp;</span><br/>
    <strong> Table :</strong> <span id="importCsvForTable">&nbsp;</span><br/><br/>

    <?php echo Html::beginForm('','post',array('enctype'=>'multipart/form-data')); ?>
    <?php echo Html::hiddenField("fileName", ""); ?>
    <?php echo Html::hiddenField("thirdStep", "0"); ?>

    <div id="importCsvFirstStep">
        <div id="importCsvFirstStepResult">
            &nbsp;
        </div>
        <?php  echo Html::button('Select CSV File', array("id"=>"importStep1")); ?>
    </div>
    <div id="importCsvSecondStep">
        <div id="importCsvSecondStepResult">
            &nbsp;
        </div>
        <strong>Fields Delimiter</strong> <span class="require">*</span><br/>
        <?php echo Html::textField("delimiter", $delimiter); ?>
        <br/><br/>
	
	<strong>Text Delimiter</strong><br/>
        <?php echo Html::textField("textDelimiter", $textDelimiter); ?>
        <br/><br/>

        <strong>Table</strong> <span class="require">*</span><br/>
        <?php echo Html::dropDownList('table', '', $tablesArray);?><br/><br/>

        <?php
        echo Html::ajaxSubmitButton('Next', '', array(
            'update' => '#importCsvSecondStepResult',
        ));
        ?>
    </div>
    <?php echo Html::endForm(); ?>

    <div id="importCsvThirdStep">
        <?php echo Html::beginForm('','post'); ?>
            <?php echo Html::hiddenField("thirdStep", "1"); ?>
            <?php echo Html::hiddenField("thirdDelimiter", ""); ?>
	    <?php echo Html::hiddenField("thirdTextDelimiter", ""); ?>
            <?php echo Html::hiddenField("thirdTable", ""); ?>
            <?php echo Html::hiddenField("thirdFile", ""); ?>
            <div id="importCsvThirdStepResult">
                &nbsp;
            </div>
            <div id="importCsvThirdStepColumnsAndForm">
                <div id="importCsvThirdStepColumns">&nbsp;</div><br/>
                <?php
                    echo Html::ajaxSubmitButton('Import', '', array(
                        'update' => '#importCsvThirdStepResult',
                    ));
                ?>
            </div>
        <?php echo Html::endForm(); ?>
    </div>
    <br/>
    <span id="importCsvBread1">&laquo; <?php echo Html::link('Start over', array("/importcsv"));?></span>
    <span id="importCsvBread2"> &laquo; <a href="javascript:void(0)" id="importCsvA2"> Fields Delimiter Text Delimiter Table');?></a></span>
</div>
