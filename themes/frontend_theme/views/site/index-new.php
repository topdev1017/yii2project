<?php 
frontend\assets\HomepageAsset::register($this);
$class = 'homepage';

use backend\models\Sliders;
?>

<div class="main-content <?=$class?>">
    <?php 
    $slider = Sliders::findOne(1);
    echo $slider->renderSlider();
    ?>
    <div style="clear: both;"></div>
    
    <section class="luminaire-selector-section">
        <div class="section-container">
            <h1>
                <span class="black small">THE WFLi</span>
                <span class="black big">LUMINAIRE</span>
                <span class="blue big">SELECTOR</span>
            </h1>
            <div class="item-rows">
                <div class="side">
                    <div class="item-box">
                        <div class="ls-icon efortless"></div>
                        <h3>EFFORTLESS</h3>
                        <p>Simply click and browse by category</p>
                    </div>
                    <div class="item-box">
                        <div class="ls-icon immediate"></div>
                        <h3>IMMEDIATE</h3>
                        <p>24/7 access works with to meet your needs</p>
                    </div>
                </div>
                <div class="side">
                    <div class="item-box">
                        <div class="ls-icon organized"></div>
                        <h3>ORGANIZED</h3>
                        <p>Save by project ease allows for easy reference</p>
                    </div>
                    <div class="item-box">
                        <div class="ls-icon share"></div>
                        <h3>SHARE</h3>
                        <p>Collaborate with clients and associates</p>
                    </div>
                </div>
            </div>
            <div class="button-container">
                <span>CLICK HERE TO</span>
                <a href="/luminaire/index" class="slant-button blue">TRY IT NOW</a>
            </div>
        </div>
    </section>
    
    
    
    <section class="homepage_content">
        <div class="center_info">
            <h1><span class="small_info">THE WFLi</span><br>
                <span class="colorblack">LUMINAIRE</span><br>
                <span class="colorblue">SELECTOR</span></h1>
            <div class="home_column_left">
                <div class="column_item">
                    <span class="icon_light_bulb icon_column"></span><span class="title">EFFORTLESS</span><br>
                    Simply click and browse by category                 
                    <br>
                </div>
                <div class="column_item">
                    <span class="icon_clock icon_column"></span><span class="title">IMMEDIATE</span><br>
                    24/7 access works with to meet your needs                 
                    <br>
                </div>
            </div>
            <div class="home_column_right">
                <div class="column_item">
                    <span class="icon_magnifing_glass icon_column"></span><span class="title">ORGANIZED</span><br>
                    Save by project ease allows for easy reference                
                    <br>
                </div>
                <div class="column_item">
                    <span class="icon_envelope icon_column"></span><span class="title">SHARE</span><br>
                    Collaborate with clients and associates                  
                    <br>
                </div>
            </div>
            <div class="clear">
            </div>
            <div class="try_now">
                <p>
                    CLICK HERE TO
                </p>
                <a href="/luminaire/index">TRY IT NOW</a>
            </div>
        </div>
    </section><section class="homepage_grid">
        <div class="grid_col left_slanted">
            <div class="grid_content">
                <h1><span class="small_info">THE WFLi</span><br>
                    <span class="colorblack">LINE</span><br>
                    <span class="colorblue">CARD</span></h1>
                <p class="subtitle" style="text-transform: none;">
                    WFLi IS A PROUD PARTNER WITH
                    <br>
                    THE FOLLOWING MANUFACTURER'S
                </p>
                <div class="clear">
                </div>
                <div class="left_slanted_button">
                    <p style="margin-top: 136px;">
                        VIEW THE WFLi
                    </p>
                    <a href="/luminaire/line-card">LINE CARD</a>
                </div>
            </div>
        </div>
        <div class="grid_col right_slanted">
            <div class="grid_content">
                <h1><span class="small_info" rel="font-size: 34px;">WFLi</span><br>
                    <span class="colorwhite" rel="font-size: 34px;">FIND OUT WHAT'S</span><br>
                    <span class="colorwhite">TRENDING</span></h1>
                <p class="subtitle">
                    Interested in the latest &amp; Greatest?
                </p>
                <p>
                    The Lighting Industry is exploding with exciting and innovative lighting and WFLi wants to keep you informed of the latest products, services and technologies. Visit our trending page often to learn about leading edge lighting products and the lighting manufacturers that are bringing you the technology and expertise you need for your projects.
                </p>
                <div class="clear">
                </div>
                <div class="right_slanted_button" style="margin-top: -5px;">
                    <p>
                        FIND OUT
                    </p>
                    <a href="/trending">WHAT'S NEW</a>
                </div>
            </div>
        </div>
        <div class="grid_col bottom_left">
            <div class="grid_content">
                <h1><span class="small_info">WELCOME TO</span><br>
                    <!--                <span class="colorblack">LINE</span><br>-->
                    <span class="colorblue">WFLi</span></h1>
                <div class="clear">
                </div>
                <p>
                    <img src="http://ls1.richmediapro.com/resources/images/tampa-homepage.jpg" alt="Welcome to WLIFi">
                </p>
                <p class="subtitle">
                    Find the Right Lighting for you.
                </p>
                <p>
                    Founded in 1980, Western Florida lighting is one of the premier lighting agencies in the country. The cornerstone of our success are the relationships that we have built with our clients. Relationships built on trust, integrity  and a belief in partnership. 
                    In 2012 new ownership was established  bringing in a business model that continues to be relationship based and also understanding that the way we do business and interact with our clients is evolving. This website is part of that evolution. We have built this website with one thing in mind, to allow our customers to easily and quickly find the right product for their project. 
                    <a href="/contact">Read more...</a>
                </p>
            </div>
        </div>
        <div class="grid_col bottom_right">
            <div class="grid_content">
                <h1><span class="small_info">FEATURED</span><br>
                    <span class="colorblack" style="text-transform: none;" rel="text-transform: none;">WFLi</span><br>
                    <span class="colorblue">COMPANY</span></h1>
                <div class="clear">
                </div>
                <p>
                    <a href="/bruck-wila"><img src="http://ls1.richmediapro.com/resources/images/bruck-bobo.jpg" alt="http://ls1.richmediapro.com/resources/images/bruck-bobo.jpg"></a>
                </p>
                <p class="subtitle">
                    <a href="/bruck-wila">Ledra Brands: Bruck &amp; Wila</a>
                </p>
                <p>
                    Over the past 30 plus years the companies have established a presence in the commercial and residential markets with a strategy of quality lighting products. Since 2000, their LED products have made them a market leader as a result of their experience and expertise with the LEDRA product line. Bruck and Wila have grown with LED technology from the start catapulting them beyond the competition in output, color quality and reliability. 
                    <a href="/bruck-wila">Read More...</a>
                </p>
            </div>
        </div>
    </section>
</div>