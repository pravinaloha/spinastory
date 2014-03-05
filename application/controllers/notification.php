<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for handling All Notification releated events
 * ===================================
 * Method List
 * =============
 * 1) index
 * 2) getAlerts
 * 3) notificationList
 */

class Notification extends CI_Controller {

    /**
     * To store notification data.
     * @var type 
     */
    public $arrNotificationData = array();

    /**
     * Index controller 
     * @return type
     */
    public function index() {
        $this->arrNotificationData['arrNotificationList'] = $this->Api->sendCurlRequest($this->config->item('notification_list'), "1");
        $this->load->template('notification/notification_list', $this->arrNotificationData);
        return;
    }

    /**
     * Function to fetch friend list
     * @return type
     */
    public function notificationList() {
        $this->arrNotificationData['arrNotificationList'] = $this->Api->sendCurlRequest($this->config->item('notification_list'), "");
        $this->load->template('notification/notification_list', $this->arrNotificationData);
        return;
    }

    /**
     * function to get notification from api
     * @return type
     */
    public function getAlerts() {

        $arrNotificationList = $this->Api->sendCurlRequest($this->config->item('notification_list'), "1");
        foreach ($arrNotificationList as $key => $objNoti) {
            switch ($objNoti->Type) {
                case '3':
                    $this->arrNotificationData['story'][] = $objNoti;
                    break;
                case '1':
                    $this->arrNotificationData['friend'][] = $objNoti;
                    break;
                default:
                    $this->arrNotificationData['notification'][] = $objNoti;
                    break;
            }
        }
        
        print_r(json_encode($this->arrNotificationData));
        return;
    }
}

/* End of file notification.php */
/* Location: ./application/controllers/notification.php */