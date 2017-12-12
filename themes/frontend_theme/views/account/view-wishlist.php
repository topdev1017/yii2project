<?php
frontend\assets\WishlistPageAsset::register($this);

use backend\models\User;
?>
<div class="main-content">
    <?=$this->render("//general_partial/_sidebar-wishlist",['model'=>$model])?>
    <div class="wishlist-page-content page-content">
        <div class="filters main-filter">
            <div class="breadcrumbs">
                <ul>
                    <li>WFLi</li>
                    <li>
                        <?php 
                        if(Yii::$app->user->isGuest) {
                            echo "Guest";
                        } else {
                            $user = User::findOne(Yii::$app->user->id);
                            echo $user->first_name." ".$user->last_name;
                        }
                        ?>
                    </li>
                    <li>WISHLIST</li>
                </ul>
            </div>
            <h3>WISHLIST</h3>
            <div class="thumb-filter filter">
                <span class="title">Thumb Size:</span>
                <ul>
                    <li><a href="#" data-size="small"></a></li>
                    <li><a href="#" data-size="medium" class="active"></a></li>
                    <li><a href="#" data-size="large"></a></li>
                </ul>
            </div>
            <div class="by-filter filter">
                <span class="title">Filter By:</span>
                <ul>
                        <li>
                            <a href="#" class="quick-ship <?=(isset($params['quick_ship']) && $params['quick_ship'] > 0 ? "active" : "")?>">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/quick-ship.png" alt="Quick Ship">
                            </a>
                        </li>
                        <li>
                            <a href="#" class="led-only <?=(isset($params['led']) && $params['led'] > 0 ? "active" : "")?>">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/led-only.png" alt="Quick Ship">
                            </a>
                        </li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="filter manufacture-list show-mobile hide-tablet hide-desktop">
                <div class="field">
                    <select class="mobile-scroll-to" placeholder="Manufacture List:">
                        <option disabled selected>Manufacture List:</option>
                        <?php 
                            $manufactures = $dataProvider->getModels();
                            if(isset($manufactures) && count($manufactures) > 0) {
                                foreach($manufactures as $manufacture) {
                                ?>
                                <option value="<?=$manufacture['MID']?>"><?=$manufacture['name']?></option>
                                <?php
                                }
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div id="results-content">
            <?=$this->render("_wishlist-products-group-list",['dataProvider'=>$dataProvider,'params'=>$params])?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".wishlist-page-content").on("click",".remove-from-wishlist", function(e) {
            e.preventDefault();
            var that = $(this);
            var item = that.closest(".item");
            var pid = that.attr("data-pid");
            var wid = '<?=$model->WID?>';
            $.ajax({
                type: 'POST',
                url: '<?=Yii::$app->UrlManager->CreateUrl(['account/wishlist-remove-item'])?>',
                data: {
                    pid: pid,
                    wid: wid  
                },
                success: function(data){
                    $("#results-content").html(data);
                    registerPopups();
                }
            });
        });
        $(".wishlist-page-content").on("click",".main-filter .by-filter a", function(e) {
            e.preventDefault();

            var container = $(this).closest(".by-filter");

            var qs = container.find(".quick-ship");
            var l = container.find(".led-only");

            var quick_ship = 0;
            var led = 0;

            $(".group-filter .by-filter .active").removeClass("active");

            if($(this).hasClass("active")) {
                $(this).removeClass("active");
            } else {
                $(this).addClass("active");
            }

            if(qs.hasClass("active")) {
                var quick_ship = 1;
                $(".group-filter .by-filter .quick-ship").addClass("active");
            }
            if(l.hasClass("active")) {
                var led = 1;
                $(".group-filter .by-filter .led-only").addClass("active");
            }

            $.ajax({
                type: 'GET',
                url: '<?=Yii::$app->UrlManager->CreateUrl(['account/wishlist-search'])?>&quick_ship='+quick_ship+'&led='+led,
                success: function(data){
                    $("#results-content").html(data);
                    registerPopups();
                }
            });

        }); 

        $(".wishlist-page-content").on("click",".group-filter .by-filter a",function(e) {
            e.preventDefault();

            var container = $(this).closest(".by-filter");
            var resultsBlock = container.closest(".item").find(".group-results");
            var mid = container.closest(".filters").attr("data-mid");

            var qs = container.find(".quick-ship");
            var l = container.find(".led-only");

            var quick_ship = 0;
            var led = 0;

            if($(this).hasClass("active")) {
                $(this).removeClass("active");
            } else {
                $(this).addClass("active");
            }

            if(qs.hasClass("active")) {
                var quick_ship = 1
            }
            if(l.hasClass("active")) {
                var led = 1
            }

            $.ajax({
                type: 'GET',
                url: '<?=Yii::$app->UrlManager->CreateUrl(['account/wishlist-search-group'])?>&mid='+mid+'&quick_ship='+quick_ship+'&led='+led,
                success: function(data){
                    resultsBlock.html(data);
registerPopups();
                }
            });

        });
        
        // on pajax refresh
        $(".pajax-container").on("pjax:complete",function() {registerPopups()});

        registerPopups();
    });
    
    function registerPopups() {
        $(".show-product-info").qtip({
            content: {
                text: function(event, api) {
                    $.ajax({ 
                        url: '<?=Yii::$app->UrlManager->createUrl("luminaire/product-info")?>',                         
                        type: 'GET',
                        data: {
                            pid: $(this).attr("data-pid")
                        }
                    }).done(function(html) {
                        api.set('content.text', html);
                        api.reposition(); 
                    }).fail(function(xhr, status, error) {
                        api.set('content.text', status + ': ' + error)
                    })

                    return '';
                }, 
                title: {
                    text: '',
                    button: 'Close'
                }
            },
            position: {
                my: 'center', // ...at the center of the viewport
                at: 'center',
                target: $(window),
                adjust : {
                    screen : true,
                    effect : {
                        type: 'slide',
                        duration: 2220,
                        threshold: 50
                    }
                }
            },
            hide: {
                event: 'unfocus'
            },
            show: {
                event: 'click',
                solo: true, // ...and hide all other tooltips...
                modal: true // ...and make it modal
            },
            style: {
                classes: "qtip-bootstrap luminaire-popup wishlist-popup",
//                'width': 700,
//                'width': 1000
            },
            events: {
                show: function(event, api) {

                },
                hide: function(event, api) {
                }
            }
        });
    }
</script>




