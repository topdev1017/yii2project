<?php 
use yii\helpers\Html;

use backend\models\Wishlist;

frontend\assets\AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <script src="//use.typekit.net/uyl6azt.js"></script>
        <script>try{Typekit.load();}catch(e){}</script>
        <?= Html::csrfMetaTags() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= Html::encode(Yii::$app->name) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>
        
        <?=$content?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>