<?php
namespace frontend\controllers;

use Yii;
use common\models\LoginFormFrontend;
use common\models\User;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use backend\models\Images;
use backend\models\SliderImages;
use backend\models\Pages;
use backend\models\RateWebsiteForm;
use yii\web\HttpException;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;

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
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            //'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
        ];
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    
    public function actionPage($id="homepage",$params = array()) {
        if(is_numeric($id)) {
            $page = Pages::findOne($id);
        } else {
            $page = Pages::find()->where(['slug'=>$id])->one();
        }
        if($page) {
            Url::remember();
            $page->parseContent();
            $this->view->params['page_id'] = $id;
            return $this->render("page",['model'=>$page]);
        } else {
            throw new HttpException(404, 'The requested page does not exist.');
        }
    }
    
    public function actionIndexNew()
    {
        return $this->render('index-new');
    }

    public function actionIndex()
    {
        Url::remember();
        return $this->render('index');
    }
    
    /*public function actionContact()
    {
        return $this->render('contact');
    }*/
    
    public function actionPartner()
    {
        return $this->render('partner');
    }
    
    public function actionComingSoon()
    {
        return $this->render('coming-soon');
    }
    
    public function actionApplications()
    {
        Url::remember();
        return $this->render('applications');
    }
    
    public function actionApplicationsHealthcare()
    {
        Url::remember();
        return $this->render('applications-healthcare');
    }
    
    public function actionApplicationsHospitality()
    {
        Url::remember();
        return $this->render('applications-hospitality');
    }
    
    public function actionApplicationsEducation()
    {
        Url::remember();
        return $this->render('applications-education');
    }
    
    public function actionApplicationsIndustrial()
    {
        Url::remember();
        return $this->render('applications-industrial');
    }
    
    public function actionApplicationsOffice()
    {
        Url::remember();
        return $this->render('applications-office');
    }
    
    public function actionApplicationsOutdoor()
    {
        Url::remember();
        return $this->render('applications-outdoor');
    }
    
    public function actionLightingControls()
    {
        Url::remember();
        return $this->render('lighting-controls');
    }
    
    public function actionLineCard()
    {
        return $this->render('line-card');
    }
    
    public function actionLuminaire()
    {
        return $this->render('luminaire');
    }
    
    public function actionLuminaireSelector()
    {
        return $this->render('luminaire-selector');
    }
    
    public function actionManageAccount()
    {
        return $this->render('manage-account');
    }
    
    public function actionManageWishlist()
    {
        return $this->render('manage-wishlist');
    }
    
    public function actionWishlistPage()
    {
        return $this->render('wishlist-page');
    }
    
    public function actionRateWebsite()
    {
        $model = new RateWebsiteForm;
        $page = Pages::find()->Where(['slug' => 'rate-website'])->one();
        if(Yii::$app->request->isPost) {
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->sendEmail()) {
                
//                $model = new RateWebsiteForm;
            }
        }
        return $this->render('ratewebsite',['model'=>$model,'page'=>$page]);
    }

    public function actionLocalProjects()
    {
        return $this->render('local-projects');
    }
    
    public function actionWhatsNew()
    {
        Url::remember();
        return $this->render('whats-new');
    }
    
    public function actionExternalUrl($url,$skipframe = false,$returnto = false)
    {
        $this->layout = "external";
        $url = urldecode($url);
        return $this->render('external',['url' => $url,'skipframe'=>$skipframe,'returnto'=> $returnto]);
    }
    
    
    
    

    public function actionSignupPage() {
        $login = new LoginFormFrontend();
        $signup = new SignupForm();
        
        if(!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        if(Yii::$app->request->isPost) {
            if(Yii::$app->request->post('LoginFormFrontend')) {
                if ($login->load(Yii::$app->request->post()) && $login->login()) {
//                    return $this->goBack();
                    return $this->redirect(Yii::$app->urlManager->createUrl("account/manage-wishlist"),302);
                }
            }
            
            if(Yii::$app->request->post('SignupForm')) {
                if ($signup->load(Yii::$app->request->post())) {
                    if ($user = $signup->signup()) {
                        if (Yii::$app->getUser()->login($user)) {
                            return $this->goHome();
                        }
                    }
                }
            }
        }
        
        return $this->render('signup-page', [
            'login' => $login,
            'signup' => $signup,
        ]);
    }
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
//             return $this->goHome();
        }
        $model = new LoginFormFrontend();
        $signup = new SignupForm();
        
        if(Yii::$app->request->isPost) {
            if(Yii::$app->request->post('LoginFormFrontend')) {
               if ($model->load(Yii::$app->request->post()) && $model->login()) {
//                    return $this->goBack();
                    return $this->redirect(Yii::$app->urlManager->createUrl("account/manage-wishlist"),302);
    
                    
               } else {
                    return $this->render('login', [
                    'model' => $model,
                    'signup' => $signup,
                    ]);
               }
            }
            
            if(Yii::$app->request->post('SignupForm')) {
                if ($signup->load(Yii::$app->request->post())) {
//                    print_r($signup->attributes);
//                    die();
                    if ($user = $signup->signup()) {
                        if (Yii::$app->getUser()->login($user)) {
                            return $this->goHome();
                        }
                    }
                }
                
                return $this->render('login', [
                    'model' => $model,
                    'signup' => $signup,
                ]);
            }
        }else {
            return $this->render('login', [
                'model' => $model,
                'signup' => $signup,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /*public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }*/

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
