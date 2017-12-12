<?php 
use yii\helpers\Html;

use backend\models\Wishlist;

frontend\assets\AppAsset::register($this);

$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;


?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
        <link rel="icon" type="image/x-icon" href="/favicon.ico" />
        <link rel="manifest" href="/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <script src="//use.typekit.net/uyl6azt.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
        <?= Html::csrfMetaTags() ?>
        <!--        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <title><?= Html::encode(Yii::$app->name) ?></title>
        <script type="text/javascript">
            var applications_help_form_url = '<?=Yii::$app->UrlManager->createUrl("luminaire/applications-help-popup")?>';
            var luminaire_selector_search = '<?=Yii::$app->UrlManager->CreateUrl(['luminaire/search'])?>';
            var luminaire_selector_search_group = '<?=Yii::$app->UrlManager->CreateUrl(['luminaire/search-group'])?>';
            var luminaire_product_info_popup = '<?=Yii::$app->UrlManager->createUrl("luminaire/product-info")?>';
            var manufacture_view_search = '<?=Yii::$app->UrlManager->createUrl("luminaire/manufacture-search")?>';
        </script>
        <!--[if lt IE 9]>
            <script src="<?=Yii::$app->view->theme->baseUrl?>/resources/js/html5shiv.js"></script>
        <![endif]-->
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        <div class="nav-mobile">
            <a href="#" class="nav-trigger">
                <span class="text">Menu</span>
            </a>
            <div class="nav">
                <ul>
                    <li>
                        <h3>Site Navigation</h3>
                        <ul>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("luminaire/index")?>">Luminaire Selector</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("luminaire/line-card")?>">Line Card</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("trending")?>">Trending</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("lighting-controls")?>">Lighting Controls</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("industry")?>">Industry</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("regulatory")?>">Regulatory</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl(["contact"])?>">Contact</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl(["rate-website"])?>">Rate our website</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>Your Account</h3>
                        <ul>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl("site/signup-page")?>">Login/Register</a></li>
                            <li><a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist",'id'=>0])?>"><span><?=Wishlist::getWishlistCount()?></span> ITEMS IN WISHLIST</a></li>
                        </ul>
                    </li>
                    <li>
                        <h3>Distributors</h3>
                        <ul>
                            <!--<li><a href="<?=Yii::$app->UrlManager->createUrl("site/coming-soon")?>">Distributor Login</a></li>-->
                            <li><a href="http://srvr.wflinc.com:8080/OASIS/desk/index.jsp">Distributor Login</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="social-icons">
                    <h3>Stay Up To Date</h3>
                    <ul>
                        <li><a href="https://www.facebook.com/pages/Western-Florida-Lighting-Inc/148576995189980" target="_blank" class="icon facebook"></a></li>
                        <li><a href="https://twitter.com/wflinc" target="_blank" class="icon twitter"></a></li>
                        <li class="pinterest"><a data-pin-do="buttonFollow" href="http://www.pinterest.com/wfli1248/">WLIFi</a></li>
                        <li><a href="https://www.youtube.com/channel/UCFhwm6PWTHlDFt0uBuSdlVQ  " target="_blank" class="icon youtube"></a></li>
                    </ul>
                </div>

                <div class="clear">&nbsp;</div>
            </div>
        </div>
        <div class="wrapper_header">
            <div class="header">
                <div class="logo">
                    <a href="<?=Yii::$app->homeUrl;?>">
                        <!--<img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/core/<?=((isset($this->params['page_id']) && $this->params['page_id'] = "homepage") ? 'logo-home.png' : 'logo.png')?>" alt="Wfli logo">-->
                        <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/core/logo.png" alt="Wfli logo">
                    </a>
                </div>
                <div class="distributor_wishlist_social">
                    <div class="distributor_wishlist">
                        <a href="<?=Yii::$app->UrlManager->createUrl(["rate-website"])?>">RATE OUR WEBSITE</a>
                        <a href="http://srvr.wflinc.com:8080/OASIS/desk/index.jsp">DISTRIBUTOR LOGIN</a>
                        <?php 
                        if(Yii::$app->user->isGuest) {
                            ?>
                            <a href="<?=Yii::$app->UrlManager->createUrl("site/signup-page")?>">LOGIN/REGISTER</a>
                            <a href="<?=Yii::$app->UrlManager->createUrl(["account/view-wishlist",'id'=>0])?>" class="wishlist-counter"><span><?=Wishlist::getWishlistCount()?></span> ITEMS IN WISHLIST</a>
                            <?php
                        } else {
                            ?>
                            <a href="<?=Yii::$app->UrlManager->createUrl("account/manage-account")?>">MANAGE ACCOUNT</a>
                            <a href="<?=Yii::$app->UrlManager->createUrl(["account/manage-wishlist"])?>" class="wishlist-counter"><span><?=Wishlist::getWishlistCount()?></span> ITEMS IN WISHLIST</a>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="upper_menu">
                    <ul>
                        <li><a <?=(($controller == "luminaire" && $action == "index") || $controller == "luminaire" && $action == "view" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl("luminaire/index")?>">LUMINAIRE SELECTOR</a></li>
                        <li><a <?=($controller == "luminaire" && $action == "line-card" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl("luminaire/line-card")?>">LINE CARD</a></li>
                        <li><a <?=($controller == "site" && $action == "trending" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl("trending")?>">TRENDING</a></li>
                        <li><a <?=($controller == "site" && $action == "lighting-controls" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl("lighting-controls")?>">LIGHTING CONTROLS</a></li>
                        <li><a <?=($controller == "site" && $action == "industry" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl("industry")?>">INDUSTRY</a></li>
                        <li><a <?=($controller == "site" && $action == "regulatory" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl("regulatory")?>">REGULATORY</a></li>
                        <li><a <?=($controller == "site" && $action == "contact" ? ' class="active"' : '')?> href="<?=Yii::$app->UrlManager->createUrl(["contact"])?>">CONTACT</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <?=$content?>

        <div style="clear: both;"></div> 
        <div class="footer_container">
            <div class="footer">
                <div class="logo">
                    <a href="<?=Yii::$app->homeUrl?>">
                        <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/footer/footer-logo.png">
                    </a>
                </div>

                <div class="nav">
                    <ul>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("luminaire/index")?>">LUMINAIRE SELECTOR</a></li>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("luminaire/line-card")?>">LINE CARD</a></li>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("trending")?>">TRENDING</a></li>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("lighting-controls")?>">LIGHTING CONTROLS</a></li>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("industry")?>">INDUSTRY</a></li>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("regulatory")?>">REGULATORY</a></li>
                        <li><a href="<?=Yii::$app->UrlManager->createUrl("contact")?>">CONTACT</a></li>
                    </ul>
                </div>

                <div class="newsletter">
                    <h3>Stay up to date</h3>

                    <div class="social-icons">
                        <ul>
                            <li><a href="https://www.facebook.com/pages/Western-Florida-Lighting-Inc/148576995189980" target="_blank" class="icon facebook"></a></li>
                            <li><a href="https://twitter.com/wflinc" target="_blank" class="icon twitter"></a></li>
                            <li class="pinterest"><a data-pin-do="buttonFollow" href="http://www.pinterest.com/wfli1248/">WLIFi</a></li>
                            <li><a href="<?=Yii::$app->urlManager->createUrl(['rate-website'])?>" class="icon rate-website"></a></li>
                            <li><a href="https://www.youtube.com/channel/UCFhwm6PWTHlDFt0uBuSdlVQ" target="_blank" class="icon youtube"></a></li>
                            
                        </ul>
                    </div>

                    <p>
                        ...or join our newsletter simply by entering <br>
                        your complete email address below.
                    </p>
                    <div class="newletter-container">
                        <form method="post" action="https://app.icontact.com/icp/signup.php" name="icpsignup" id="icpsignup3850" accept-charset="UTF-8" onsubmit="return verifyRequired3850();" class="newsletter-form" >
                            <input type="hidden" name="redirect" value="http://wfli.com/thank-you">
                            <input type="hidden" name="errorredirect" value="http://wfli.com/error">
                            <input type="text" placeholder="E-Mail Address" name="fields_email">
                            <input type="submit" value="Subscribe" name="Submit" class="submit-button">
                            <input type="hidden" name="listid" value="33901">
                            <input type="hidden" name="specialid:33901" value="CEVR">
                            <input type="hidden" name="clientid" value="1212824">
                            <input type="hidden" name="formid" value="3850">
                            <input type="hidden" name="reallistid" value="1">
                            <input type="hidden" name="doubleopt" value="0">
                        </form>
                    </div>
                    <script type="text/javascript">

                        var icpForm3850 = document.getElementById('icpsignup3850');

                        if (document.location.protocol === "https:")

                            icpForm3850.action = "https://app.icontact.com/icp/signup.php";
                        function verifyRequired3850() {
                            if (icpForm3850["fields_email"].value == "") {
                                icpForm3850["fields_email"].focus();
                                alert("The Email field is required.");
                                return false;
                            }


                            return true;
                        }
                    </script>
                </div>

                <div class="copyright">
                    &copy; 2015 | WFLi
                </div>
            </div>
        </div>
        <div class="clear"></div>
        <script type="text/javascript">
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-63423101-1', 'auto');
            ga('send', 'pageview');
        </script>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>