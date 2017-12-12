<?php
frontend\assets\ExternalUrlAsset::register($this);
use yii\helpers\Url;
$hash = "";
if(Yii::$app->request->get('target')) {
    $hash = "#".Yii::$app->request->get('target');
}
?>

<div class="external-url">
    <header class="frame-header">
        <div class="wrapper">
            <div class="logo">
                <img src="<?=Yii::$app->view->theme->baseUrl?>/resources/images/core/logo.png" alt="WFLi logo">
            </div>
            <div class="links">
                <ul>
                    <li><a href="<?=$url?>" class="remove-frame">REMOVE FRAME</a></li>
                    <li><a href="<?=($returnto !== false ? $returnto : Url::previous()).$hash;?>">BACK TO WFLi</a></li>
                    <li><a href="<?=$url?>" class="report">REPORT BROKEN LINK</a></li>
                </ul>
            </div>
        </div>
    </header>
    <iframe id="external-iframe" src="<?=$url?>" width="100%" height="100%">
    
    </iframe>
</div>
<script type="text/javascript">
function resizeIframe() {
    var windowHeight = $(window).height();
    var headerHeight = $(".frame-header").height();
    var frameHeight = windowHeight - headerHeight;
    
    $("#external-iframe").css("height",frameHeight);
}
$(window).resize(function() {
    resizeIframe();
})
$(document).ready(function() {
    resizeIframe()
    $(".report").on("click",function(e){
        e.preventDefault();
        
        var data = {
            url: $(this).attr("href"),
            '_csrf': '<?=Yii::$app->request->csrfToken?>'
        };
        $.ajax({
            url: '<?=Yii::$app->UrlManager->createUrl("account/report-broken-url")?>',     
            type: 'POST',
            data: data,
            dataType: "json",
            success: function(response) {
                if(response.status == "OK") {
                    window.location.href = '<?=Yii::$app->homeUrl?>'
                } 
            }
        })
    });
})
</script>