<?php
namespace backend\models;

use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class PartnerForm extends Model
{
    public $full_name;
    public $company;
    public $email;
    public $phone;
    public $flight_info;
    public $hotel_info;
    public $rental_car_info;
    public $sales_plan;
    public $literature;
    public $samples;
    public $from_date;
    public $to_date;
    
    public $send_to = "no-reply@wfli.com";
    public $subject = "New Partner";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['full_name','company','email','phone','flight_info','hotel_info','rental_car_info','sales_plan','literature','samples','from_date','to_date'], 'required'],
            [['full_name','company','email','phone','flight_info','hotel_info','rental_car_info','sales_plan','literature','samples','from_date','to_date'], 'safe'],
            ['email','email']
        ];
    }
    
    public function sendEmail() {
        return Yii::$app->mailer->compose('PartnerForm',['model'=> $this])
            ->setTo($this->send_to)
            ->setFrom([$this->email => $this->full_name])
            ->setSubject($this->subject)
            ->send();
    }

}
