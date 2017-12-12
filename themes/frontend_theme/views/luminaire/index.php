<?php
frontend\assets\LuminaireAsset::register($this);
use backend\models\Pages;
?>
<div class="main-content ">
    <?=$this->render("//general_partial/_sidebar-ls")?>
    <div class="luminaire-content main-content-of-page luminaire-selector-content ajax-content">
        <?php 
        $page = Pages::find()->Where(['slug'=>'luminaire/index'])->one();
        if($page) {
            $page->parseContent();
            echo $page->content;
        } else {
            ?>
            <div class="luminaire-content-header">    
            <div class="get_started">
                TO GET STARTED, CHOOSE A <br/> CATEGORY FROM THE <span class="hide-mobile">LEFT COLUMN NAVIGATION</span><span class="show-mobile-inline hide-tablet hide-desktop">NAVIGATION ABOVE</span>.
            </div>
            <div class="luminaire-content-header-line"></div>
            <div class="or">
                or, for further instructions, play our short video below.
            </div>
        </div>
        <div class="content">
            <h1>FEATURES OF THE LUMINAIRE SELECTOR</h1>
            
            <h3>WHAT'S INCLUDED IN THE LUMINAIRE SELECTOR?</h3>
            <p class="safe-width">Over 1,500 of our most popular products in 20 different <br> categories. Not every product or category is found in the <br> Luminaire Selector. More products can be found using our <br> Line Card, What's New and Applications pages or by <br>calling us at 952-943-8080.</p>
            
            <h3>CREATE A WISHLIST</h3>
            <p>
                Simply click "Add to Wishlist" to remember<br> which light you were interested in.
            </p>
            <h3>PROJECT PRIVACY</h3>
            <p>
                We do not and will never track your projects.
            </p>

            <h3>NEED LED OR QUICK SHIP PRODUCTS?</h3>
            <p>
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire/sorting-graphic.jpg">
            </p>
            <p>
                Use the new sorting option <br/> on the luminaire page.
            </p>
            <h2>LUMINAIRE SELECTOR TUTORIAL</h2>
            <iframe class="luminaire-tutorial-iframe" width="560" height="315" src="https://www.youtube.com/embed/kYuMm5dl7zY" frameborder="0" allowfullscreen></iframe>
            
        </div>
            <?php
            
        }
        ?>
    </div>
</div>