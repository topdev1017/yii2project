<?php
namespace backend\models;

use yii\base\Model;
use Yii;
use yii\validators\EmailValidator;

/**
 * Signup form
 */
class RateWebsiteForm extends Model
{
    public $success = false;
    public $rating = 3;
    public $comments;
    public $name;
    public $company;
    public $phone;
    public $email;
    
    public $sent_to = "timg@wfli.com";
    public $sent_to_name = "WFLI";
    
    public $sent_from = "luminaires@wfli.com";
    public $sent_from_name = "WFLi";
    
    public $subject = "Website Feedback";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email','rating','name','comments'], 'required'],
            [['email','rating','name','comments','company','phone'], 'safe'],
            ['email','email']
        ];
    }
    
    public function sendEmail() {
        return $this->success = Yii::$app->mailer->compose('RateWebsiteForm',['model'=> $this])
            ->setTo($this->sent_to)
            ->setFrom([$this->sent_from => $this->sent_from_name])
            ->setSubject($this->subject)
            ->send();
    }

}
