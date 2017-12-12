<?php
frontend\assets\WishlistPageAsset::register($this);
?>
<div class="main-content">
    <?=$this->render("//general_partial/_sidebar")?>
    <div class="wishlist-page-content page-content">
        <div class="filters main-filter">
            <div class="breadcrumbs">
                <ul>
                    <li>MLAZGAR ASSOCIATES</li>
                    <li>USERNAME</li>
                    <li>WISHLIST NAME</li>
                </ul>
            </div>
            <h3>WISHLIST NAME</h3>
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
                        <a href="#" class="quick-ship">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/quick-ship.png" alt="Quick Ship">
                        </a>
                    </li>
                    <li>
                        <a href="#" class="led-only">
                            <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/led-only.png" alt="Quick Ship">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="clear"></div>
            <div class="filter manufacture-list show-mobile hide-tablet hide-desktop">
                <div class="field">
                    <select>
                        <option>Manufacture List:</option>
                    </select>
                </div>
            </div>
        </div>
        <ul class="products">
            <li class="item">
                <div class="header">
                    <h3>AMERLUX</h3>
                    <a href="javascript:void()" class="scroll-top hide-tablet hide-desktop" data-target=".wishlist-page-content">Top</a>
                    <div class="products-menu hide-mobile">
                        <a href="#" class="trigger">Menu</a>
                        <div class="popup-content">
                            <div class="filters group-filter">
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
                                            <a href="#" class="quick-ship">
                                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/quick-ship.png" alt="Quick Ship">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="led-only">
                                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/led-only.png" alt="Quick Ship">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="categories">
                                <ul>
                                    <li class="selected"><a href="#">Amerlux</a></li>
                                    <li><a href="#">Axo Light</a></li>
                                    <li><a href="#">Cerno</a></li>
                                    <li><a href="#">Chameleon Lighting</a></li>
                                    <li><a href="#">Con-Tech</a></li>
                                    <li><a href="#">Contard</a></li>
                                    <li><a href="#">Davis-Muller</a></li>
                                    <li><a href="#">Flos</a></li>
                                    <li><a href="#">Focal Point</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="group-results">
                    <ul class="products-group">
                        <li class="item product-box">
                            <p>Hornet HP Pendant Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Signal Grande</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED + Quick Ship</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Fino Ceilling Mount Wall Wash</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">More Info</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Manuel Vivian Line Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED + Quick Ship</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Hornet HP Pendant Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">More Info</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>

                        <li class="item product-box">
                            <p>Hornet HP Pendant Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Signal Grande</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED + Quick Ship</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Fino Ceilling Mount Wall Wash</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">More Info</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Manuel Vivian Line Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED + Quick Ship</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Hornet HP Pendant Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">More Info</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>

                        <li class="item product-box">
                            <p>Hornet HP Pendant Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Signal Grande</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED + Quick Ship</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Fino Ceilling Mount Wall Wash</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">More Info</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Manuel Vivian Line Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp2();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">LED + Quick Ship</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                        <li class="item product-box">
                            <p>Hornet HP Pendant Light</p>
                            <div class="thumb" onclick="showAddToWishlistPopUp();">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire-selector/thumbs-middle.jpg">
                            </div>
                            <div class="specifications">More Info</div>
                            <a href="#" class="remove-item">Remove Item</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>


