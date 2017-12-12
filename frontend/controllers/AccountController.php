<?php

namespace frontend\controllers;

use Yii;
use backend\models\ManageAccountForm;
use backend\models\Products;
use backend\models\User;
use backend\models\PartnerForm;
use backend\models\Categories;
use backend\models\Wishlist;
use backend\models\WishlistProducts;
use backend\models\CategoriesSearch;
use backend\models\ProductsSearch;
use backend\models\ManufacturesSearch;
use frontend\models\SignupForm;

use backend\models\WishlistEmailForm;

use yii\helpers\Url;
use yii\web\Cookie;
use yii\web\HttpException;

class AccountController extends \yii\web\Controller
{
    public function actionManageAccount()
    {
        if(Yii::$app->user->isGuest) {
            return $this->goBack();
        }
        $model = new SignupForm;
        $model->setUser(Yii::$app->user->id);
//        $model->scenario = "update";
        if($model) {
            
            if(Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                if($model->validate() && $model->update()) {
                    
                }
            }
            
            return $this->render('manage-account', ['model'=>$model]);
        }
        
        
    }
    public function actionSetCustomImage() {
        if(!Yii::$app->user->isGuest) {
            $user = User::findOne(Yii::$app->user->id);
            if($user) {
                if(Yii::$app->request->isPost) {
                    $image = Yii::$app->request->post('file');
                    if($image) {
                        $tmp_ext = array_reverse(explode(".",$image));
                        $ext = strtolower($tmp_ext[0]);
                        $dir = Yii::getAlias('@root_name')."/resources/custom_images/";
                        $file = $dir.$image;
                        $newFileName = $user->id.".".$ext;
                        $newFile = $dir.$newFileName;
                        if(is_file($file)) {
                            $handle = rename($file,$newFile);
                            if($handle) {
                                $user->avatar = $newFileName;
                                $user->save(false);
                                echo json_encode(['status'=>'OK']);
                            }
                        }
                    }
                }
            }
            
        }
        
    }
    
    public function actionUpload() {
        $script_url =  Yii::getAlias('@script_url'); //'http://localhost/howtube/';
            $upload_dir =  Yii::getAlias('@root_name')."/resources/custom_images/";// 'C:/xampp/htdocs/howtube/temp/images/';
            $upload_url =   Yii::getAlias('@script_url').'/resources/custom_images/';

            $options = array(
                'script_url' => $script_url,
                'upload_dir' => $upload_dir,
                'upload_url' => $upload_url,
                'param_name' => 'custom_image',
            );
            
            //print_r($options);
//            die();
            
            $upload_handler = new UploadHandler($options, true);
            $result_json = $upload_handler->do_upload();
            $result = json_decode($result_json);
            print_r($result_json);
            Yii::$app->end();
    }
    
    public function actionReportBrokenUrl() {
        if(Yii::$app->request->isPost) {
            $url = Yii::$app->request->post('url');
            
            $model = new ReportBrokenLinkForm;
            $model->url = $url;
            
            if($model->sendEmail()){
                echo json_encode(['status'=>'OK']);
            }
            
            
        }
    }
    
    public function actionSendWishlist() {
        if(Yii::$app->request->isPost) {
            $model = new WishlistEmailForm;
            
            $model->load(Yii::$app->request->post());
            
            if($model->validate() && $model->sendEmail()) {
                echo json_encode(['status'=>'OK','message'=>'Sent Successfully']);
            } else {
                $message = '<div>Please fix the following errors:</div>';
                foreach($model->getErrors() as $field => $error) {
                    $message .= "<p>".implode("</p><p>",$error)."</p>";
                }
//                $message = substr($message,0,-2);
                echo json_encode(['status'=>'ERROR','message'=>$message]);
            }
        } else {
            echo json_encode(['status'=>'ERROR','message'=>'Invalid Request']);
        }
//        return $this->renderPartial("//emails/WishlistEmailForm");
    }
    
    public function actionManageWishlist()
    {
        $model = new Wishlist;
        if(Yii::$app->request->isPost && !Yii::$app->user->isGuest) {
            $model->load(Yii::$app->request->post());
            $model->UID = Yii::$app->user->id;
            if($model->save()) {
                $model = new Wishlist;
            }
        }
        return $this->render('manage-wishlist',['model'=>$model]);
    }
    
    public function actionDeleteWishlist($id) {
        if($id > 0) {
            if(!Yii::$app->user->isGuest) {
                Wishlist::deleteAll(['WID'=>$id,'UID'=>Yii::$app->user->id]);
                WishlistProducts::deleteAll(['WID'=>$id,'UID'=>Yii::$app->user->id]);
            }
        } else {
            $newCookie = serialize([]);
                        
            Yii::$app->response->cookies->add(new Cookie([
                'name' => 'wlifi-wishlist-products',
                'value' => $newCookie,
                'expire' => time() + 86400 * 30,
                'secure' => false,
                'path' => '/'
            ]));
        }
        
        return $this->redirect(Yii::$app->urlManager->createUrl("account/manage-wishlist"),302);
    }
    
    public function actionWishlistRemoveItem() {
        if(Yii::$app->request->isPost) {
            $products = [];
            if(Yii::$app->user->isGuest) {
                if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
                    $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
                    $products = unserialize($cookie);
                }
                if(($key = array_search(Yii::$app->request->post('pid'), $products)) !== false) {
                    
                    unset($products[$key]);
                }
                $newCookie = serialize($products);
                 
                Yii::$app->response->cookies->add(new Cookie([
                    'name' => 'wlifi-wishlist-products',
                    'value' => $newCookie,
                    'expire' => time() + 86400 * 30,
                    'secure' => false,
                    'path' => '/'
                ]));
            } else {
                WishlistProducts::deleteAll(['UID'=>Yii::$app->user->id,'PID'=>Yii::$app->request->post('pid'),'WID'=>Yii::$app->request->post('wid')]);
                
                $products_obj = WishlistProducts::find()->where(['WID'=>Yii::$app->request->post('wid')])->all();
                if($products_obj) {
                    foreach($products_obj as $prod) {
                        array_push($products,$prod->PID);
                    }
                }
            }
            
            $params['in'] = $products;
        
            $dataProvider = ManufacturesSearch::getProductForWishlistIn($params);
            return $this->renderPartial('_wishlist-products-group-list',['dataProvider'=>$dataProvider,'params'=>$params]);
        }
    }
    
    public function actionViewWishlist($id)
    {
        $model = Wishlist::findOne($id);
        $products = [];
        
        if(Yii::$app->user->isGuest) {
            $model = new Wishlist;
            $id = 0;
            if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
                $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
                $products = unserialize($cookie);
            }
        } else {
            ini_set("memory_limit","1024M");
            if($model) {
                $products_obj = WishlistProducts::find()->where(['WID'=>$model->WID])->all();
                if($products_obj) {
                    foreach($products_obj as $prod) {
                        array_push($products,$prod->PID);
                    }
                }
            } else {
                return $this->goBack();
            }
            
        }
        
        
        $params['in'] = $products;
        
        $dataProvider = ManufacturesSearch::getProductForWishlistIn($params);
        
        return $this->render('view-wishlist',['dataProvider'=>$dataProvider,'params'=>$params,'model'=>$model]);
    }
    
    public function actionWishlistSearch()
    {
        $products = [];
        if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
            $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
            $products = unserialize($cookie);
        }
        
        if(Yii::$app->request->isGet) {
            if(Yii::$app->request->get('led')) {
                $params['led'] = Yii::$app->request->get('led');
            }
            if(Yii::$app->request->get('quick_ship')) {
                $params['quick_ship'] = Yii::$app->request->get('quick_ship');
            }
        }
        $params['in'] = $products;
        
        $dataProvider = ManufacturesSearch::getProductForWishlistIn($params);
        return $this->renderPartial('_wishlist-products-group-list',[
            'dataProvider' => $dataProvider,
            'params' => $params
        ]);
        
    } 
    
    public function actionWishlistSearchGroup($mid)
    {
        $products = [];
        if(Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
            $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
            $products = unserialize($cookie);
        }     
        
        if(Yii::$app->request->isGet) {
                
            if(Yii::$app->request->get('led')) {
                $params['led'] = Yii::$app->request->get('led');
            }
            if(Yii::$app->request->get('quick_ship')) {
                $params['quick_ship'] = Yii::$app->request->get('quick_ship');
            }
        }
        $params['in'] = $products;
        $params['MID'] = $mid;
        
        $dataProvider = ProductsSearch::searchProductsByManufactureID($params);
        
        return $this->renderPartial('_wishlist-products-group-results-list',[
            'dataProvider' => $dataProvider,
            'params' => $params,
        ]);
        
    }
    
    /*public function actionWishlistCount() {
        if(Yii::$app->user->isGuest) {
            if(!Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
                
            } else {
                echo json_encode()
            }
        }
    }*/
    public function actionAddToWishlist() {
        Yii::$app->response->format = 'json';
        if(Yii::$app->request->isPost) {
            $product = Products::findOne(Yii::$app->request->post('pid'));
            
            if($product) {
                if(Yii::$app->user->isGuest) {
                    
                    if(!Yii::$app->request->cookies->has('wlifi-wishlist-products')) {
                    
                        $newCookie = serialize([$product->PID]);
                        
                        Yii::$app->response->cookies->add(new Cookie([
                            'name' => 'wlifi-wishlist-products',
                            'value' => $newCookie,
                            'expire' => time() + 86400 * 30,
                            'secure' => false,
                            'path' => '/'
                        ]));
                        
                        return (['status'=>"OK",'message'=>'Added to Wishlist','count'=>1]);
//                        return Yii::$app->response;

                    } else {
                        // verify if is in wishlist
                        $cookie = Yii::$app->request->cookies->getValue('wlifi-wishlist-products');
                        $cookie_arr = unserialize($cookie);
                        if(!in_array($product->PID,$cookie_arr)) {
                            array_push($cookie_arr,$product->PID);
                        } 
                        
                        $newCookie = serialize($cookie_arr);
                        Yii::$app->response->cookies->add(new Cookie([
                            'name' => 'wlifi-wishlist-products',
                            'value' => $newCookie,
                            'expire' => time() + 86400 * 30,
                            'secure' => false,
                            'path' => '/'
                        ]));
                        
//                        setCookie('wlifi-wishlist-products',$newCookie);
                        return (['status'=>"OK",'message'=>'Added to Wishlist','count'=>count($cookie_arr)]);
//                        return json_encode(['status'=>"OK",'count'=>count($cookie_arr)]);
                    }
                } else {
                    $wishlist = Wishlist::findOne(Yii::$app->request->post('wid'));
                    if($wishlist) {
                        $wproducts = WishlistProducts::find()->where(['WID'=>$wishlist->WID,
                        'PID'=>$product->PID,'UID'=>Yii::$app->user->id])->one();
                        if(empty($wproducts)) {
                            $model = new WishlistProducts;
                            $model->WID = $wishlist->WID;
                            $model->PID = $product->PID;
                            $model->UID = Yii::$app->user->id;
                            
                            if($model->save()) {
                                return (['status'=>"OK",'user'=>'login','count'=>WishlistProducts::find()->where(['UID'=>Yii::$app->user->id])->count()]);
                            }
                        } else {
                            return (['status'=>"ERROR",'message'=>'Product already is added']);
                        }
                    } else {
                        return (['status'=>"ERROR",'message'=>'Wishlist does not exist']);
                    }
                }
            }
        }
    }
    
    public function actionPartner() {
        $model = new PartnerForm;
        
        if(Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            
            if($model->validate() && $model->sendEmail()) {
                $model = new PartnerForm;
            } 
//            var_dump($model->send_to); 
            
        }
        
        return $this->render("partner",['model'=>$model]);
    }

}
