<?php
namespace backend\models;

use yii\base\Model;
use Yii;
use yii\validators\EmailValidator;

/**
 * Signup form
 */
class WishlistEmailForm extends Model
{
    public $email;
    public $wishlist_id;
    public $subject;
    public $message;
    
    public $sent_from = "luminaires@wfli.com";
    public $sent_from_name = "WFLI";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email','subject','message'], 'required'],
            [['email','subject','message','wishlist_id'], 'safe'],
            ['email','emailValidate']
        ];
    }
    
    public function emailValidate($attribute, $param) {
        $validator = new EmailValidator();
        $emails = explode(" ",$this->$attribute);
        if($emails && count($emails) > 0) {
            foreach($emails as $email) {
                if (!$validator->validate($email,$error)) {
                    $this->addError($attribute, "'".$email."' is invalid.");
                } 
            }
            $this->$attribute = $emails;
        }
               
    }
    
    public function sendEmail() {
        return Yii::$app->mailer->compose('WishlistEmailForm',['model'=> $this])
            ->setTo($this->email)
            ->setFrom([$this->sent_from => $this->sent_from_name])
            ->setSubject($this->subject)
            ->send();
    }

}
