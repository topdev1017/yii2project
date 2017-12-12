<?php
frontend\assets\LuminaireAsset::register($this);
?>
<div class="main-content">
    <div class="main-menu">
        <div class="categories">
            <ul>
                <li>
                    <h3>WISHLIST</h3>
                    <ul>
                        <li><a href="#">0 ITEMS IN WISHLIST</a></li>
                        <li><a href="#">VIEW WISHLIST</a></li>
                    </ul>
                </li>
                <li>
                    <h3>INTERIOR LIGHTING</h3>
                    <ul>
                        <li>
                            <a href="#">QUICK SHIP INTERIOR</a>
                        </li>
                        <li>
                            <a href="#">Pendants</a>
                            <ul>
                                <li><a href="#" class="selected">AMERLUX</a></li>
                                <li><a href="#" class="selected">AXO LIGHT</a></li>
                                <li><a href="#" class="selected">CERNO</a></li>
                                <li><a href="#" class="selected">CHAMELEON LIGHTING</a></li>
                                <li><a href="#" class="selected">CONTARDI</a></li>
                                <li><a href="#" class="selected">DAVIS-MULLER</a></li>
                                <li><a href="#" class="selected">FLOS</a></li>
                                <li><a href="#" class="selected">FOCAL POINT</a></li>
                            </ul>
                        </li>
                        <li><a href="#">WALL</a></li>
                        <li><a href="#">CEILING MOUNT</a></li>
                        <li><a href="#">DECORATIVE DOWNLIGHT</a></li>
                        <li><a href="#">RECESSED INDIRECT/DIRECT</a></li>
                        <li><a href="#">LINEAR RECESSED</a></li>
                        <li><a href="#">PERIMETER SYSTEM</a></li>
                        <li><a href="#">COVE</a></li>
                        <li><a href="#">TRACK LIGHTING</a></li>
                        <li><a href="#">LED INTERIOR</a></li>
                    </ul>
                </li>
                <li>
                    <h3>EXTERIOR LIGHTING</h3>
                    <ul>
                        <li><a href="#">QUICK SHIP EXTERIOR</a></li>
                        <li><a href="#">SITE/POLE MOUNTED</a></li>
                        <li><a href="#">BOLLARD/LOW LEVEL</a></li>
                        <li><a href="#">WALL MOUNT</a></li>
                        <li><a href="#">FLOODLIGHTS</a></li>
                        <li><a href="#">IN GRADE</a></li>
                        <li><a href="#">ARHITECTURAL HANDRAIL</a></li>
                        <li><a href="#">LED EXTERIOR</a></li>
                    </ul>
                </li>
                <li>
                    <h3>SPECIALIZED CATEGORY</h3>
                    <ul>
                        <li><a href="#">ACCENT</a></li>
                        <li><a href="#">CUSTOM</a></li>
                        <li><a href="#">DISPLAY</a></li>
                        <li><a href="#">HEALTHCARE</a></li>
                        <li><a href="#">HIGH ABUSE</a></li>
                        <li><a href="#">INDUSTRIAL</a></li>
                        <li><a href="#">LANDSCAPE</a></li>
                        <li><a href="#">PARKING GARAGE</a></li>
                        <li><a href="#">POLES</a></li>
                        <li><a href="#">RECESSED DOWNLIGHTS</a></li>
                        <li><a href="#">RESIDENTIAL</a></li>
                        <li><a href="#">RLM DOMES/SHADES</a></li>
                        <li><a href="#">ROADWAY/SITE</a></li>
                        <li><a href="#">SOLAR POWERED LIGHTING</a></li>
                        <li><a href="#">SPORTS LIGHTING</a></li>
                        <li><a href="#">THEATRICAL LIGHTING</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <div class="comercial">
            <p class="comercial_take_a_look">TAKE A LOOK AT</p>
            <p class="whats_new">WHAT'S NEW!</p>
            <p class="click_here">CLICK HERE</p>
        </div>
    </div>
    <div class="luminaire-content">
        <div class="luminaire-content-header">    
            <div class="get_started">
                TO GET STARTED, CHOOSE A <br/> CATEGORY FROM THE LEFT COLUMN NAVIGATION.
            </div>
            <div class="luminaire-content-header-line"></div>
            <div class="or">
                or, for further instructions, play a short video below.
            </div>
        </div>
        <div class="content">
            <h1>FEATURES OF THE LUMINAIRE SELECTOR</h1>

            <h3>CREATE A WISHLIST</h3>
            <p>
                Simply click "Add to Wishlist" to remember<br> which light you were interested in.
            </p>
            <h3>PROJECT PRIVACY</h3>
            <p>
                We do not and will never track your projects.
            </p>

            <h3>NEED LED OR QUICK SHIP PRODUCTS?</h3>
            <select>
                <option>Sorting Options...</option>
            </select>
            <p>
                Use the new sorting option <br/> on the luminaire page.
            </p>
            <h2>LUMINAIRE SELECTOR TUTORIAL</h2>
            <p>
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/luminaire/content-youtube.jpg">
            </p>
        </div>
    </div>
</div>