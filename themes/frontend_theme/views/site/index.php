<?php 
frontend\assets\HomepageAsset::register($this);
?>

<div class="main-content">
    <div class="homepage">
        <div class="main_display">
            <div class="slider">
                <div class="bxslider">
                    <div class="slide active">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'http://www.hubbellindustrial.com/products/nutriled'])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-1.jpg">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'http://www.hubbellindustrial.com/products?Product%20Group[]=Highbay+LED'])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-2.jpg">
                        </a>
                    </div>
                    <!--<div class="slide">
                    <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'####'])?>">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-3.jpg">
                    </a>
                    </div>-->
                    <div class="slide">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'http://www.hubbellindustrial.com/products/lbx/'])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-4.jpg">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'http://www.hubbellindustrial.com/products?Product%20Group[]=Lightwatt+LED'])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-5.jpg">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'http://www.hubbellindustrial.com/products?Product%20Group[]=Kemlux+III'])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-6.jpg">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="<?=Yii::$app->urlManager->createUrl(['site/external-url','url'=>'http://www.hubbellindustrial.com/'])?>">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/slider/slide-7.jpg">
                        </a>
                    </div>
                </div>
            </div>
            <div class="featured">
                <h3>FEATURED MANUFACTURER</h3>
                <div class="featured-image">
                    <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/hubell-lighting.jpg">
                </div>
                <h4>No One Knows How To Light Critical Work Areas Better </h4>
                <p>Engineering tough, hard-working products designed for the real world-products that survive high temps, wet and dirty conditions, and diverse lighting requirements...</p>
                <a href="<?=Yii::$app->UrlManager->createUrl("luminaire/index")?>" class="view-products">View Luminaire Selector</a>

            </div>
        </div>
        <div style="clear: both;"></div>
        <div class="round_section">
            <div class="round_section_div">
                <a href="<?=Yii::$app->UrlManager->createUrl("luminaire/index")?>">
                    <div class="line"></div>
                    <div class="round luminaire_selector"></div>
                    <center>
                        <p>LUMINAIRE SELECTOR</p>
                        <div>A rich search tool to help you select Mlazgar lighting solutions that fit your projects. Search by application, price, quick-ship, or LED light source...</div>
                    </center>
                </a>
            </div>
            <div class="round_section_div">
                <a href="<?=Yii::$app->UrlManager->createUrl("luminaire/line-card")?>">
                    <div class="line"></div>
                    <div class="round line_card"></div>
                    <center>
                        <p>LINE CARD</p>
                        <div>At Mlazgar, we work with only the best quality lighting manufacturers. Peruse, print, or download the line card... </div>
                    </center>
                </a>
            </div>
            <div class="round_section_div">
                <a href="<?=Yii::$app->UrlManager->createUrl("site/whats-new")?>">
                    <div class="line"></div>
                    <div class="round whats_new"></div>
                    <center>
                        <p>WHAT'S NEW?</p>
                        <div>When you love trends, Mlazgar keeps you connected. Turn on a light, and check out today's latest products, manufacturers, news, and events...</div>
                    </center>
                </a>
            </div>
            <div class="round_section_div">
                <a href="<?=Yii::$app->UrlManager->createUrl("site/applications")?>">
                    <div class="line"></div>
                    <div class="round applications"></div>
                    <center>
                        <p>APPLICATIONS</p>
                        <div>Find innovative ideas and design tips using the latest technologies in lighting and lighting controls. Don't miss our photo gallery of local projects...</div>
                    </center>
                </a>
            </div>
        </div>
        <div class="horizontal_line"></div>
        <div class="bottom_homepage">
            <div class="bottom_text">
                <h3>
                    WELCOME TO
                    <span>MLAZGAR ASSOCIATES</span>
                </h3>
                <p class="welcome_to_text">For over 50 years Mlazgar Associates has been a respected and trusted sales agency covering the states of Minnesota, North Dakota, South Dakota and western Wisconsin. We provide exceptional sales support and timely customer service for many of the industry's most valued brands of lighting and controls. Mlazgar Associates is committed to exceeding customer expectations through all phases of a project - initial design development, specification, quotation, project management, system commissioning and warranty issues. This will be accomplished with person to person service and the highest level of integrity, honesty and respect for the relationships that have been built over decades.  </p>
                <p class="welcome_to_text">Chances are you have enjoyed some of our products while going to school, working, eating out, enjoying a sporting event or driving to your favorite destination. We feel very fortunate to have been involved on so many great projects with the best design professionals, electrical contractors and distributors. Thank you!</p> 
                <!--<p class="welcome_to_text">As your industry leader in the world of lighting and lighting controls, Mlazgar Associates is providing phenomenal innovative lighting solutions for a myriad of applications covering Minnesota, North Dakota, South Dakota and Western Washington.  We rely on state-of-the-art brands for the products you need to complete your lighting and lighting control projects, with dedication to personal service, honest transactions, and utmost integrity. Offering customers over 50 years of custom support, at Mlazgar you find the knowledge and expertise to take your lighting projects to a new level. Supporting the spaces that are a part of your everyday life, Mlazgar can invigorate your world with powerful solutions for: </p>-->
                <p class="align-center">
                    Classrooms   -   Conference Rooms   -   Cultural Venues <br>
                    Custom Offices Spaces   -   Dining Establishments   -   Libraries <br>
                    Luxury Hotels   -   Offices   -   Reception Areas

                </p>
                <div class="page-slogan">
                    We Work Hard For You
                </div>
            </div>
            <div class="youtube_player">
                <!--<img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/homepage/youtube.jpg">-->
                <h3>
                    About
                    <span>Estiluz</span>
                </h3>
                <p>
                    Estiluz, founded in 1969, is a leader in the contemporary decorative lighting market. For over forty years, they have been an innovator of high end luminaired that excite the mind and spirit of the design comunity. Utilizing the highest grade materials and finishes available. <b>Designs for a lifetime, products for a lifetime. </b>
                </p>
                <iframe width="100%" height="240" src="https://www.youtube.com/embed/ecgwkibO2EU" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

    </div>
</div>