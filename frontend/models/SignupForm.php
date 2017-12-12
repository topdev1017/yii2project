<?php
namespace frontend\models;

use common\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $_model;
    public $UID;
    public $username;
    public $email;
    public $password;
    public $password2;
    public $company;
    public $company_website;
    public $phone;
    public $first_name;
    public $last_name;
    
    public $custom_image;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //['username', 'filter', 'filter' => 'trim'],
//            ['username', 'required'],
//            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
//            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            [['password','password2'], 'required'],
            ['password', 'compare', 'compareAttribute'=>'password2'],
            ['password', 'string', 'min' => 6],
           
            
            [['first_name', 'last_name'], 'required'],
            [['password','password2','first_name', 'last_name','company','company_website','phone','email'], 'safe']
        ];
    }
    
    public function setUser($id) {
        $this->_model = User::findOne($id);
        if($this->_model) {
            $this->first_name = $this->_model->first_name;
            $this->last_name = $this->_model->last_name;
            $this->email = $this->_model->email;
            $this->phone = $this->_model->phone;
            $this->company = $this->_model->company;
            $this->company_website = $this->_model->company_website;
        }
        return $this;
    }
    
    public function update() {
        
        $this->_model->first_name = $this->first_name;
        $this->_model->last_name = $this->last_name;
        $this->_model->email = $this->email;
        $this->_model->phone = $this->phone;
        $this->_model->company = $this->company;
        $this->_model->company_website = $this->company_website;
        
        $this->_model->setPassword($this->password);
        $this->_model->generateAuthKey();
        
        if ($this->_model->save()) {
            return $this->_model;
        } 
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
       
        if ($this->validate()) {
//            print_r($this->attributes);
            
            $user = new User();
            $user->attributes = $this->attributes;
            $user->first_name = $this->first_name;
            $user->last_name = $this->last_name;
            $user->company = $this->company;
            $user->company_website = $this->company_website;
            $user->phone = $this->phone;
            $user->username = $this->email;
            $user->email = $this->email;
            $user->created_at = date("Y-m-d H:i:s");
//            print_r($user->attributes);
//            die();
            $user->setPassword($this->password);
            $user->generateAuthKey();
            if ($user->save()) {
                return $user;
            }
        }
//        print_r($this->errors);
//        
//         die();

        return null;
    }
    
}
