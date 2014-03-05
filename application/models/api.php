<?php

/**
 * Class to handle all kind of API through curl.
 * ============================================
 * 
 * Method List
 * ===========
 * 1) sendCurlRequest
 * 2) parseJson
 * 
 */
class Api extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Send curl request
     *
     * @param string $strUrl
     * @param string $strContent
     * @return String
     */
    public function sendCurlRequest($strUrl, $strContent = '', $strExtra = '', $strMethod = 'POST') {
        try {
            $strToken = $this->config->item('token');

            if ($strUrl !== '' && $strUrl != null) {
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $strContent);
                curl_setopt($ch, CURLOPT_URL, $strUrl . $strToken . $strExtra);
                curl_setopt($ch, CURLOPT_POST, ($strMethod === 'GET') ? 0 : 1);
                curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/Json"));

                $response = curl_exec($ch);
                return $this->parseJson($response);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
        }
        return false;
    }

    /**
     * Function to parse json
     * @param type $arrJson
     * @return type
     */
    private function parseJson($arrJson) {
        $arrData = json_decode($arrJson);

        if (isset($arrData->Error))
            return array();

        if (isset($arrData->Items))
            return $arrData->Items;

        return $arrData;
    }

}

?>
