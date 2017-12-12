<?php 
switch($model->PgID) {
    case "1":
        //homepage
        frontend\assets\HomepageAsset::register($this);
        $class = 'homepage';
    break;
    case "2":
        //contact
        frontend\assets\ContactAsset::register($this);
        $class = 'contact';
    break;
    case "3":
        //whats new
        frontend\assets\WhatsNewAsset::register($this);
        $class = 'whats-new-content';
    break;
    case "4":
        //lighting controls
        frontend\assets\LightingControlsAsset::register($this);
        $class = 'lighting-controls';
    break;
    case "5":
    case "6":
    case "7":
    case "8":
    case "9":
    case "10":
    case "11":
        //applications
        frontend\assets\ApplicationsAsset::register($this);
        $class = 'applications';
    break;
    case "12":
        //local projects
        frontend\assets\LocalProjectsAsset::register($this);
        $class = 'local-projects';
    break;    
    
    default:
        frontend\assets\CMSAsset::register($this);
        $class = "";
    break;
}

?>

<div class="main-content <?=$class?>">
    <?=$model['content']?>
</div>