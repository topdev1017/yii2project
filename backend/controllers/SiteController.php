<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use yii\db\Query;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error','clear-data'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index','clear-data'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'clear-data' => ['post','get'],
                ],
            ],
        ];
    }
    
    public function actionClearData() {
        if(Yii::$app->request->isPost && isset($_POST['clear-the-data'])) {
            $sql = "
                TRUNCATE `categories`;
                TRUNCATE `categories_tags`;
                TRUNCATE `finishes`;
                TRUNCATE `manufactures`;
                TRUNCATE `manufacture_specialized`;
                TRUNCATE `manufacture_tags`;
                TRUNCATE `products`;
                TRUNCATE `product_categories`;
                TRUNCATE `product_finishes`;
                TRUNCATE `product_sizes`;
                TRUNCATE `product_tags`;
                TRUNCATE `sizes`;
                TRUNCATE `specialized`;
                TRUNCATE `tags`;
            ";
            
            $connection = \Yii::$app->db;
            $query = $connection->createCommand($sql)->query();
//            $query = false;
            if($query) {
                return $this->goHome();
            }

        }
        return $this->render('clear-data');
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            //echo "<pre>";
//            echo print_r(Yii::$app->user);
//            echo "</pre>";
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
