<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use backend\models\Products;
use backend\models\Manufactures;
use backend\models\ReportBrokenLinkForm;

class CoreController_ extends Controller {

    public function actionIndex($args,$value=false) {
        switch($args) {
            case "brokenlinks":
                if(!$value) {
                    echo "Invalid command. Valid options are: products, manufactures, all";
                    yii::$app->end();
                } else {
                    $this->reportBrokenLinks($value); 
                }

                break;
            default:
                echo "Invalid command. Valid options are: brokenlinks [products|manufactures|all]"; 
                yii::$app->end();
                break;
        }
    }

    public function reportBrokenLinks($value) {
        ini_set("memory_limit","1024M");
        ini_set("max_execution_time","0");
        switch($value) {
            case "products":
                $models = Products::find()->each(50);
                break;
            case "manufactures":
                $models = Manufactures::find()->each(50);
                break;
            case "all":
                $this->reportBrokenLinks('products');
                $this->reportBrokenLinks('manufactures');
                yii::$app->end();
                break;
            default:
                echo "Invalid command. Valid options are: brokenlinks [products|manufactures|all]"; 
                yii::$app->end();
                break;
        }
        echo "Executing batch job for broken links: ".$value;
        if($models) {

            foreach($models as $i => $model) {
                $url = ($value=="manufactures" ? $model->url : $model->manufacture_product_url);
                if(!empty($url)) {
                    $response = $this->testUrl($url);

                    if($response['code'] == '404' || $response['code'] !== '200' && $response['redirects'] > 0) {

                        $form = new ReportBrokenLinkForm();
                        $form->url = $url;
                        if($value == "manufactures") {
                            $form->extra_data = "<p>Manufacture ID: ".$model->MID."</p>";
                        } else {
                            $form->extra_data = "<p>Product ID: ".$model->PID."</p>";
                        }

                        $form->extra_data .= "<p><strong>Headers Response</strong></p>";
                        $form->extra_data .= "<pre>".print_r($response,true)."</pre>";
                        $form->sendEmail();
                    } 
                }



            }
        }
    }


    public function testUrl($url) {
        $options['http'] = array(
            'method' => "HEAD",
            'ignore_errors' => 1,
        );
        $context = stream_context_create($options);
        $body = file_get_contents($url, NULL, $context);
        $responses = $this->parse_http_response_header($http_response_header);

        $return = [
            'code'=>$responses[0]['status']['code'],
            'redirects'=>(count($responses) - 1),
            'full_response' => $responses
        ];

        if ($return['redirects']){

            $return['from'] = $url;

            foreach (array_reverse($responses) as $response)
            {
                $return['code'] = $response['status']['code'];
            }
            //echo "<br>\n";
        }

        return $return;
    }

    public function parse_http_response_header(array $headers)
    {
        $responses = array();
        $buffer = NULL;
        foreach ($headers as $header)
        {
            if ('HTTP/' === substr($header, 0, 5))
            {
                // add buffer on top of all responses
                if ($buffer) array_unshift($responses, $buffer);
                $buffer = array();

                list($version, $code, $phrase) = explode(' ', $header, 3) + array('', FALSE, '');

                $buffer['status'] = array(
                    'line' => $header,
                    'version' => $version,
                    'code' => (int) $code,
                    'phrase' => $phrase
                );
                $fields = &$buffer['fields'];
                $fields = array();
                continue;
            }
            list($name, $value) = explode(': ', $header, 2) + array('', '');
            // header-names are case insensitive
            $name = strtoupper($name);
            // values of multiple fields with the same name are normalized into
            // a comma separated list (HTTP/1.0+1.1)
            if (isset($fields[$name]))
            {
                $value = $fields[$name].','.$value;
            }
            $fields[$name] = $value;
        }
        unset($fields); // remove reference
        array_unshift($responses, $buffer);

        return $responses;
    }
}