<?php
frontend\assets\LuminaireAsset::register($this);
use backend\models\Pages;
?>
<div class="main-content ls-landing-page">
    <?=$this->render("//general_partial/_sidebar-ls")?>
    <div class="luminaire-content main-content-of-page luminaire-selector-content ajax-content">
        <?php 
        $page = Pages::find()->Where(['slug'=>'luminaire/index-new'])->one();
        if($page) {
            $page->parseContent();
            echo $page->content;
        } else {
            ?>
            <div class="content">
                <div class="ls-landing-header">
                    <h1>
                        LUMINAIRE SELECTOR
                        <small>SELECT A CATEGORY FROM THE <i class="hide-mobile">LEFT COLUMN NAVIGATION</i><i class="show-mobile-inline hide-tablet hide-desktop">NAVIGATION ABOVE</i></small>    
                    </h1>

                    <a href="https://youtu.be/8V6Qxp21QUY" target="_blank" class="watch-video view-video"><i></i>CLICK HERE TO <small>VIEW OUR TUTORIAL VIDEO</small></a>
                </div>
                
                <div class="ls-landing-content">
                    <div class="text-container">
                        <p>Select from over 5,000 of our most popular products in 20 <br> different categories. Additional luminaries and lighting controls <br> can be found using our Line Card, What's New and Applications <br> pages or by calling us at 727-733-7000.</p>
                        
                        <div class="row cols_2">
                            <div class="side keep-mobile">
                                <div class="features-area">
                                    <i class="icon small icon-effortless"></i>
                                    <h3>EFFORTLESS</h3>
                                    <p>Simply click and <br> browse by category</p>
                                </div>
                            </div>
                            <div class="side keep-mobile">
                                <div class="features-area">
                                    <i class="icon small icon-immediate"></i>
                                    <h3>IMMEDIATE</h3>
                                    <p>24/7 access works with <br> you to meet your needs</p>
                                </div>
                            </div>
                        </div>
                        <div class="row cols_2">
                            <div class="side keep-mobile">
                                <div class="features-area">
                                    <i class="icon small icon-organized"></i>
                                    <h3>ORGANIZED</h3>
                                    <p>Save by projet ease <br> allows for easy reference</p>
                                </div>
                            </div>
                            <div class="side keep-mobile">
                                <div class="features-area">
                                    <i class="icon small icon-share"></i>
                                    <h3>SHARE</h3>
                                    <p>Collaborate with <br> clients and associates</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="ls-landing-tutorial-box">
                            <a href="https://youtu.be/8V6Qxp21QUY" target="_blank" class="watch-video view-video icon-play-video"></a>
                            
                            <h3>VIEW OUR TUTORIAL VIDEO</h3>
                            <p>Click here to watch our video on the how best <br> to use the WFLi Luminaire Selector.</p>
                        </div>
                        
                    </div>
                    
                    [slider id="22"]
                    
                    <div class="ls-landing-featured-box">
                        <a href="">
                            <img src="http://wfli.com/resources/images/ls-landing-hubbel-logo.png">
                            <!--<img src="/resources/images/luminaire/ls-landing-hubbel-logo.png" alt="hubbell Lighting">-->
                        </a>
                        
                        <div class="text-container">
                            <h3>HUBBELL LIGHTING</h3>
                            <p>Hubbell Lighting, headquartered in Greenville, SC, is a core business platform of Hubbell Incorporated. The platform supplies a comprehensive range of indoor and outdoor lighting products to industrial, commercial and institutional applications and is the largest manufacturer of residential lighting fixtures in North America</p>
                            <p>Hubbell Lighting draws great inspiration from the company's long history of proven performance since 1888 and its culture of new product innovation.</p>
                            <p class="button">
                                <a href="#" class="view">Visit Hubbell <i></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php

        }
        ?>
    </div>
</div>