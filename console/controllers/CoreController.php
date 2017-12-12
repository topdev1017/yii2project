<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use backend\models\Products;
use backend\models\Manufactures;
use backend\models\ReportBrokenLinkForm;

class CoreController extends Controller {

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
                $models = Products::find()->where(['status' => '1'])->each(50);
                break;
            case "manufactures":
                $models = Manufactures::find()->where(['status' => '1'])->each(50);
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
        echo "[".date("H:i:s")."]"." Executing Cron for: ".$value;
        echo "\n";

        if($models) {
            
            $file = Yii::getAlias('@runtime')."/logs/".$value."-brokenlinks-".date("Y-m-d").".csv";
//            echo $file;
            $handler = fopen($file, "w") or die ("could not create logfile");
            if($value == "manufactures") {
                fputcsv($handler, array('MID','URL','STATUS','CODE','NOTES'));
            } else {
                fputcsv($handler, array('PID','URL','STATUS','CODE','NOTES'));
            }
            foreach($models as $i => $model) {
                
                
                $row = array(
                    '', // MID/PID
                    '', // URL
                    '', // STATUS
                    '', // CODE
                    '', // Notes
                );
                $url = ($value=="manufactures" ? $model->url : $model->manufacture_product_url);
                if(!empty($url)) {
                    if($this->strpos_arr($url,array("http://","https://")) === false) {
                        $row[4] = $row[4]."URL is missing the http/https prefix. ";
                        $url = "http://".$url;
                    }
                    if(strpos($url," ") !== false) {
                        $row[4] = $row[4]."URL has a space within it. There should be NO spaces. Also the url should not have space before http/https ";
                        $url = str_replace(" ","",$url);
                    }

                    if (!filter_var($url, FILTER_VALIDATE_URL)) {
                        $row[4] = $row[4]."The URL is Invalid ";
                        $response = array(
                            'code' => 9999,
                            'redirects' => 0
                        );
                    } else {
                        $response = $this->testUrl($url);
                    }
                    
                    if($value == "manufactures") {
                        $row[0] = $model->MID;
                    } else {
                        $row[0] = $model->PID;
                    }
                    $row[1] = $url;
                    $row[3] = $response['code'];
                    
//                    if(($response['code'] == '404' || $response['code'] !== '200') && $response['redirects'] > 1) {
                    if(intval($response['code']) !== 200) {
                        $row[2] = "FAILED";
                    } else {
                        $row[2] = "OK";
                    }
                    echo "[".date("H:i:s")."]"." ".implode(",",$row)."\n";
                    fputcsv($handler,$row);
                }


            }
            fclose($handler);
            $form = new ReportBrokenLinkForm();
            $form->attachments = $file;
            $form->sendEmailWithAttachment();
            
        } else {
            echo "No" .$value." found";
        }
    }

    public function strpos_arr($haystack, $needle) {
        if(!is_array($needle)) $needle = array($needle);
        foreach($needle as $what) {
            if(($pos = strpos($haystack, $what))!==false) return $pos;
        }
        return false;
    }


    public function testUrl($url) {
        $options['http'] = array(
            'method' => "HEAD",
            'ignore_errors' => 1,
            'user_agent' => 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.2490.71 Safari/537.36',
        );
        $context = stream_context_create($options);
        try {
            $body = @file_get_contents($url, NULL, $context);
        } catch (Exception $e) {
            $body = false;
        }

        if($body === false ) {
            $return = [
                'code'=>404,
                'redirects'=>0,
                'full_response' => array()
            ]; 
            return $return;
        }

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