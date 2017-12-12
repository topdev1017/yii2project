<?php 
use backend\models\ProductsSearch;

?>
<ul id="manufacture_group" class="products">
    <li class="item">
        <div class="group-results" id="manuf_<?=$manufacture['MID']?>">
            <?php 
            $params['MID'] = $manufacture['MID'];
            //        echo "<pre>";
            //        print_r($params);
            //        echo "</pre>";
            //    $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
            $dataProvider->pagination = false;
            echo $this->render("_item_group_list",[
                'dataProvider'=>$dataProvider,
                'model'=>$manufacture,
            ]);
            ?>
        </div>
    </li>
</ul>