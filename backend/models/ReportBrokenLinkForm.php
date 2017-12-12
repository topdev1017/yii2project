<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;

/**
* Signup form
*/
class ReportBrokenLinkForm extends Model
{
    public $email;
    public $subject = "Broken Links";
    public $url;
    public $extra_data;
    public $attachments = array();

    public $sent_from = "luminaires@wfli.com";
    public $sent_from_name = "WFLi Cron";
    public $send_to = "lana@targetsourcemedia.com";
    public $send_to_name = "WFLi Broken Url";
    

    /**
    * @inheritdoc
    */
    public function rules()
    {
        return [
//            [['email','subject','url'], 'required'],
            [['email','subject','url','attachments'], 'safe'],
        ];
    }

    public function sendEmail() {
        return Yii::$app->mailer->compose('ReportBrokenUrl',['url'=> $this->url,'extra_data'=>$this->extra_data])
        ->setTo([$this->send_to => $this->send_to_name])
        ->setFrom([$this->sent_from => $this->sent_from_name])
        ->setSubject($this->subject." ".$this->url)
        ->send();
    }
    
    public function sendEmailWithAttachment() {
        $mailer = Yii::$app->mailer->compose('ReportBrokenUrlWithAttach');
        $mailer->setTo([$this->send_to => $this->send_to_name]);
        $mailer->setFrom([$this->sent_from => $this->sent_from_name]);
        $mailer->setSubject($this->subject." ".$this->url);
        if(is_array($this->attachments)) {
            if(count($this->attachments) > 0) {
                foreach($this->attachments as $attachment) {
                    $mailer->attach($attachment);
                }
            }
        } else {
            $mailer->attach($this->attachments);
        }
        
        return $mailer->send();
    }

}
