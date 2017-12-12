<?php 
use backend\models\User;
use backend\models\Products;
use backend\models\ProductsSearch;
use backend\models\WishlistProducts;
use yii\helpers\Url;


$has_custom_image = false;

$products = [];
if(!isset($model->wishlist_id) || $model->wishlist_id < 1 || empty($model->wishlist_id)) {
    if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
        $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
        $cookie_arr = unserialize($cookie);
//        print_r($cookie_arr);die();
        foreach($cookie_arr as $coo) {
            $productModel = Products::findOne($coo);
            if($productModel) {
                array_push($products,$productModel);
            }
        }
    }
} else {
    $wpmodels = WishlistProducts::find()->where(['WID'=>$model->wishlist_id])->all();
    if($wpmodels) {
        foreach($wpmodels as $wpmodel) {
            array_push($products,$wpmodel);
        }
    }
}

//print_r($products);
//die();

$models = $products
?>
<html>
    <head>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body style="font-family: 'Open Sans', Arial, sans-serif;color:#333;">
        <table style="width:80%; margin:0 auto;border:0;font-family:'Myriad Pro'">
            
            <tr>
                <td>
                    <center>
                        <table style="width:80%;margin:0 auto;border:none; padding:30px 0;">
                            <tr>
                                <td style="border-top:1px solid #000;border-bottom:1px solid #000;text-align:center;padding:30px 0;color:#333;">
                                    <p style="text-align:center; font-size:18px;line-height:26px;font-family: 'Open Sans', Arial, sans-serif;color:#333;">
                                        Your WFLi wishlist items are listed below. <br>
                                        
                                        Simply click on the image to view more information
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </center>
                </td>
            </tr>
            <tr>
                <td style="font-family: 'Open Sans', Arial, sans-serif; font-size:14px; line-height:20px;padding-bottom:40px;color:#333;">
                    <?=nl2br($model->message)?>
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width:100%; border:none;">
                    <?php 
                    $chunks = array_chunk($models,3);
                    foreach($chunks as $chunk) {
                        ?>
                        <tr>
                        <?php 
                        foreach($chunk as $prod) {
                            if(is_object($prod) && get_class($prod) == 'backend\models\WishlistProducts') {
                                $prod = Products::findOne($prod['PID']);
                            }
//                            echo get_class($prod);
//                            print_r($prod);die();
//                            $productObj = $prod[''];
                            if(!empty($prod['image']) && is_file(Yii::$app->basePath."/../resources/products/".$prod['image'])) {
                                $image = "resources/products/".$prod['image'];
                            } else {
                                $image = "resources/images/luminaire-selector/thumbs-middle.jpg";
                            }
                            
                            $name = $prod->name ;
                            if(strlen($name) > 30) {
                                $name = substr($name,0,40)."...";
                            }
//                            print_r($prod);
                            ?>
                            <td width="175px" style="width:175px; padding:10px; vertical-align:top" valign="top">
                                <table width="175px">
                                    <tr>
                                        <td style="vertical-align: middle;color:#333;min-height:40px;max-height:40px;height:40px;line-height:18px; font-size:14px;text-align:center;font-family: 'Open Sans', Arial, sans-serif;">
                                            <a href="<?=Url::toRoute(['site/external-url','url'=>$prod['manufacture_product_url'],'returnto'=>Url::toRoute('luminaire/index',true)], true);?>" style="display:block;text-decoration:none;color:#333;min-height:40px;max-height:40px;overflow:hidden;width:100%; line-height:18px; font-size:14px;text-align:center;font-family: 'Open Sans', Arial, sans-serif;text-align:center;"><?=$name?></a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="175px" height="185px" style="width:175px; height:185px;"> 
                                            <a href="<?=Url::toRoute(['site/external-url','url'=>$prod['manufacture_product_url'],'returnto'=>Url::toRoute('luminaire/index',true)], true);?>" style="display: block;width:175px;">
                                                <img width="175" src="<?=Url::base(true)."/".$image?>" style="width:175px; border:none;" >
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="background:#3399cc;width:100%; color:#fff; text-align:center; display:block;text-decoration:none; font-size:13px;font-family: 'Open Sans', 'Arial', sans-serif;height:40px;vertical-align:middle;text-align:center;text-transform:uppercase" valign="middle">
                                            <a href="<?=Url::toRoute(['site/external-url','url'=>$prod['manufacture_product_url'],'returnto'=>Url::toRoute('luminaire/index',true)], true);?>" style="text-decoration:none; color:#fff; line-height:40px;">
                                            <?php 

                                            if($prod->led == 1 && $prod->quick_ship == 1){
                                                echo 'Led + Quick Ship';
                                            }elseif($prod->led == 1){
                                                echo 'Led';
                                            }elseif($prod->quick_ship == 1){
                                                echo 'Quick Ship';
                                            }else{
                                                echo 'More info';
                                            }
                                            ?>
                                            
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <?php
                        } 
                        
                        if(count($chunk) < 3) {
                            for($i = 0; $i < (3 - count($chunk));$i++) {
                                ?>
                                <td width="175px" style="width:175px; padding:10px;">&nbsp;
                                </td>
                                <?php
                            }
                        }
                        ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>    
                </td>
            </tr>
            <tr>
                <td>
                    <table style="width: 100%;">
                        <tr>
                            <td style="width:50%;margin:0 auto;text-align:center">
                                <p style="font-size:10px;color:#333;line-height:20px;margin:0;padding:0 0 20px 0;font-family: Arial, sans-serif;;vertical-align:top;">POWERED BY</p>
                                <img src="<?=Url::base(true)?>/themes/frontend_theme/resources/images/core/logo.png" alt="WFLi" style="height:70px;max-width:100%;">
                            </td>
                            <?php 
                            $img_url = "";
                            if(!Yii::$app->user->isGuest) {
                                $user = User::findOne(Yii::$app->user->id);
                                if($user) {
                                    $img_url = Url::base(true)."/resources/custom_images/".$user->avatar;
                                    $has_custom_image = true;
                                }
                                
                            } else {
                                $has_custom_image = false;
                            }
                            if($has_custom_image) {
                                ?>
                                <td style="width:50%;margin:0 auto;text-align:center;padding-left:40px;vertical-align:top;">
                                <p style="font-size:10px;color:#333;line-height:20px;margin:0;padding:0 0 20px 0;font-family: Arial, sans-serif;">PRESENTED BY</p>
                                <img src="<?=$img_url?>" alt="WFLi" style="height:70px">
                                </td>
                                <?php
                            }
                            ?>
                            
                        </tr>
                    </table>
                </td>
            </tr>
            
        </table>
    </body>
</html>