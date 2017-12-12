<?php 
frontend\assets\SpecializedAsset::register($this);
?>
<div class="main-content specialized">
    <?=$this->render("//general_partial/_sidebar")?>
    <div class="page-content main-content-of-page">
        <h1>Specialized Categories</h1>
        <div class="row">
            <div class="side">
                <h3>For all your specialized lighting needs</h3>

                <p>Mlazgar Associates represents manufacturers that provide lighting fixtures for specialized projects. Simply choose the type of lighting need from the list, and you will be provided with our manufacturer's that offer that particular specialized lighting. From there you can visit the manufacturer's website where you will find more information.</p>
            </div>
            <div class="side">
                <h3>Specialized Categories</h3>
                <?php 
                $catModels = $dataProvider->getModels();

                if($catModels > 0) {

                    $chunks = array_chunk($catModels,(($dataProvider->totalCount +1) / 2));
                    foreach($chunks as $chunk) {
                        ?><ul><?php
                            foreach($chunk as $model) {
                                ?><li><a href="<?=Yii::$app->UrlManager->createUrl("specialized/index")?>#spec_<?=$model['SpID']?>" class="scroll-top" data-target=".spec_<?=$model['SpID']?>"><?=$model['name']?></a></li><?php 
                            }
                        ?></ul><?php
                    }

                }


                ?>
            </div>
        </div>
        <?=$this->render("_list_specialized",['dataProvider' =>$dataProvider])?>
    </div>

</div>