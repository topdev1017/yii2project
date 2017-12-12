<?php
frontend\assets\LocalProjectsAsset::register($this);
?>
<div class="main-content local-projects">
    <h1><span>Local Projects</span></h1>
    <p>This page highlights a few of the local projects we have been involved in over the years. We work very hard to make sure these projects meet the needs of the entire project team. Please contact us if you would like to share your project photos.</p>



    <div class="row">
        <div class="side">
            <h3>Educational Applications</h3>

            <div class="slider">
                <div class="slides bxslider">
                    <?php 

                    $captions = array(
                        'Normadale CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'Normadale CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'Normadale CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'Normadale CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'Normadale CC Kopp Student Center | Location: Bloomington, MN | Engineer: LHB Engineers & Architects',
                        'University of Wisconsin Eau Claire l Location: Eau Claire, WI l Kim Lighting',
                        'University of Wisconsin Eau Claire l Location: Eau Claire, WI l Kim Lighting',
                        'University of Wisconsin Eau Claire l Location: Eau Claire, WI l Kim Lighting',
                        'University of Wisconsin Eau Claire l Location: Eau Claire, WI l Kim Lighting',
                    );
                    for($i=1;$i <= 12; $i++) {
                        $ext = "jpg";    
                        ?>
                        <div class="slide">
                            <a href="javascript:void(0)" class="view-large">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/educational-projects/<?=$i?>.<?=$ext?>" title="<?=(isset($captions[($i-1)]) ? $captions[($i-1)] : '')?>" />
                                <span class="overlay">
                                    <span class="content">
                                        <span class="icon"></span>
                                        <span class="text">Click to <span>enlarge</span></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <?php } ?>
                </div>
                <div class="pager pager-slider">
                    <?php 
                    for($i=1;$i <= 12; $i++) {
                        $ext = "jpg";    
                        ?>
                        <a data-slide-index="<?=($i-1)?>" href="javascript:void(0)"><img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/educational-projects/<?=$i?>-thumb.<?=$ext?>" /></a>
                        <?php } ?>
                </div>
            </div>

        </div>
        <div class="side">
            <h3>Indoor Lighting</h3>

            <div class="slider">
                <div class="slides bxslider">
                    <?php 
                    $captions = array(
                        'TSP Office | Location: Sioux Falls, SD | Engineer: TSP Four Inc. ',
                        'TSP Office | Location: Sioux Falls, SD | Engineer: TSP Four Inc ',
                        'TSP Office | Location: Sioux Falls, SD | Engineer: TSP Four Inc. ',
                        'TSP Office | Location: Sioux Falls, SD | Engineer: TSP Four Inc ',
                        'Sumner Library I Location: Minneapolis, MN ',
                        'Sumner Library I Location: Minneapolis, MN ',
                        'Medrad | Location: Coon Rapids, MN | Architect: Architectural Alliance | Engineer: Dunham Associates ',
                        'Medrad | Location: Coon Rapids, MN | Architect: Architectural Alliance | Engineer: Dunham Associates ',
                        'Medrad | Location: Coon Rapids, MN | Architect: Architectural Alliance | Engineer: Dunham Associates ',
                        'Medrad | Location: Coon Rapids, MN | Architect: Architectural Alliance | Engineer: Dunham Associates ',
                        'Twin Cities Premium Outlets l Location: Eagan, MN l Ace Electrical Contractors ',
                        'Twin Cities Premium Outlets l Location: Eagan, MN l Ace Electrical Contractors ',
                        'Twin Cities Premium Outlets l Location: Eagan, MN l Ace Electrical Contractors ',
                        'Twin Cities Premium Outlets l Location: Eagan, MN l Ace Electrical Contractors ',
                        'BWBR Office | Location: St. Paul, MN | Architect: BWBR Architects ',
                        'Wyman Building I Location: Minneapolis,MN ',
                        'Wyman Building I Location: Minneapolis,MN ',
                        'Wyman Building I Location: Minneapolis,MN ',
                        'Wyman Building I Location: Minneapolis,MN ',
                        'Xcel Energy Center Corporate Office I Location: St. Paul, MN',

                    );
                    for($i=1;$i <= 21; $i++) {
                        $ext = "jpg";    
                        ?>
                        <div class="slide">
                            <a href="javascript:void(0)" class="view-large">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/indoor-lighting/<?=$i?>.<?=$ext?>" title="<?=(isset($captions[($i-1)]) ? $captions[($i-1)] : '')?>" />
                                <span class="overlay">
                                    <span class="content">
                                        <span class="icon"></span>
                                        <span class="text">Click to <span>enlarge</span></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <?php } ?>
                </div>
                <div class="pager pager-slider">
                    <?php 
                    for($i=1;$i <= 21; $i++) {
                        $ext = "jpg";    
                        ?>
                        <a data-slide-index="<?=($i-1)?>" href="javascript:void(0)"><img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/indoor-lighting/<?=$i?>-thumb.<?=$ext?>" /></a>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="side">
            <h3>Street &amp; Outdoor Lighting</h3>

            <div class="slider">
                <div class="slides bxslider">
                    <?php 
                    $captions = array(
                        'City of Osseo | Location: Osseo, MN | Engineer: Bolton & Menk, Barr Engineering ',
                        'City of Osseo | Location: Osseo, MN | Engineer: Bolton & Menk, Barr Engineering ',
                        'Lake Elmo ',
                        'Legacy Village ',
                        'Legacy Village 7012192 ',
                        'Michelson Library I Location: South Dakota I Architectural Area Lighting ',
                        'Michelson Library I Location: South Dakota I Architectural Area Lighting ',
                        'Minnehaha Park | Location: Minneapolis, MN | Municipal: City of Minneapolis ',
                        'Picture 021 ',
                        'Picture 021-1 ',
                        'Main Street Lighting I Location: Salem, SD I Sternberg Lighting ',
                        'Main Street Lighting I Location: Salem, SD I Sternberg Lighting ',
                        'Main Street Lighting I Location: Salem, SD I Sternberg Lighting ',
                        'Spencer',
                        'Troy-burne',
                    );
                    for($i=1;$i <= 15; $i++) {
                        $ext = "jpg";    
                        ?>
                        <div class="slide">
                            <a href="javascript:void(0)" class="view-large">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/street-outdoor/<?=$i?>.<?=$ext?>" title="<?=(isset($captions[($i-1)]) ? $captions[($i-1)] : '')?>" />
                                <span class="overlay">
                                    <span class="content">
                                        <span class="icon"></span>
                                        <span class="text">Click to <span>enlarge</span></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <?php } ?>
                </div>
                <div class="pager pager-slider">
                    <?php 
                    for($i=1;$i <= 15; $i++) {
                        $ext = "jpg";    
                        ?>
                        <a data-slide-index="<?=($i-1)?>" href="javascript:void(0)"><img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/street-outdoor/<?=$i?>-thumb.<?=$ext?>" /></a>
                        <?php } ?>
                </div>
            </div>
        </div>
        <div class="side">
            <h3>Sports Lighting</h3>

            <div class="slider">
                <div class="slides bxslider">
                    <?php 
                    $captions = array(
                        'Target Field I Location: Minneapolis,MN',
                        'Target Field I Location: Minneapolis,MN',
                        'Target Field I Location: Minneapolis,MN',
                    );
                    for($i=1;$i <= 3; $i++) {
                        $ext = "jpg"; 
                        ?>
                        <div class="slide">
                            <a href="javascript:void(0)" class="view-large">
                                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/sports-lighting/<?=$i?>.<?=$ext?>" title="<?=(isset($captions[($i-1)]) ? $captions[($i-1)] : '')?>" />
                                <span class="overlay">
                                    <span class="content">
                                        <span class="icon"></span>
                                        <span class="text">Click to <span>enlarge</span></span>
                                    </span>
                                </span>
                            </a>
                        </div>
                        <?php } ?>
                </div>
                <div class="pager pager-slider">
                    <?php 
                    for($i=1;$i <= 3; $i++) {
                        $ext = "jpg";
                        ?>
                        <a data-slide-index="<?=($i-1)?>" href="javascript:void(0)"><img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/local-projects/slides/sports-lighting/<?=$i?>-thumb.<?=$ext?>" /></a>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>