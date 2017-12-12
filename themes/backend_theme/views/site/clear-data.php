<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Clear Website Data';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
<h1>Clear Website Data</h1>
<p>This operation will clear all website data. This means the products, categories, manufacturers, finishes, etc will all be removed.</p>
<p>&nbsp;</p>
<p>Are you sure you want to clear all website data?</p>
<p>
<?= Html::submitButton('Yes', ['class' => 'btn bg-olive', 'name' => 'clear-the-data']) ?>&nbsp;
<a href="<?=Yii::$app->UrlManager->createUrl("site/index")?>" class="btn bg-black">No</a>
</p>
<?php ActiveForm::end(); ?>
