<?php 
    class Curl {
        public $service_url;

        public function send_request() {
            $curl = curl_init($this->service_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $curl_response = curl_exec($curl);
            $response;
            if ($curl_response === false) {
                $info = curl_getinfo($curl);
                curl_close($curl);
                $response = array("error" => 'error occured during curl exec. Additional info: ' . var_export($info));
                die();
            } else {
                curl_close($curl);
                $response = json_decode($curl_response);
            }
            return $response;
        }
    } 
?>