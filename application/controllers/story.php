<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for handling All Story events
 * ===================================
 * Method List
 * =============
 * 1) index
 * 2) storyList
 * 3) addNewStory
 * 4) getTitleSuggesion
 * 5) getStarterSuggesion
 * 6) getTitleByGenre
 * 7) respondToStoryRequest
 * 8) addStoryInviteFriend
 */
class Story extends CI_Controller {

    /**
     * To store Story data.
     * @var type 
     */
    public $arrStoryData = array();

    /**
     * Index action
     */
    public function index() {

        try {
            // set facebook user info inti session
            if (!$this->session->userdata('username')) {
                $arrUserData = $this->facebook->api('/me');
                $this->session->set_userdata($arrUserData);
            }
        } catch (FacebookApiException $e) {
            error_log($e);
        }

        $this->arrStoryData['arrStoryList'] = $this->Api->sendCurlRequest($this->config->item('story_list'));
        $this->load->template('story/story_list', $this->arrStoryData);
        return;
    }

    /**
     * Function to fetch story list
     * @return type
     */
    public function storyList() {
        $this->arrStoryData['arrStoryList'] = $this->Api->sendCurlRequest($this->config->item('story_list'));
        $this->load->template('story/story_list', $this->arrStoryData);
        return;
    }

    /**
     * Function to add new story
     * @return type
     */
    public function addNewStory() {
        $this->arrStoryData['arrFriendList'] = $this->Api->sendCurlRequest($this->config->item('friend_list'));
        $this->arrStoryData['arrSuggesionList'] = $this->Api->sendCurlRequest($this->config->item('genre_list'));
        $this->load->template('story/new_story', $this->arrStoryData);
        return;
    }

    /**
     * Function to get story title suggession list
     * @return type
     */
    public function getTitleSuggesion() {
        $this->arrStoryData['suggession'] = 'title';
        $this->arrStoryData['arrSuggesionList'] = $this->Api->sendCurlRequest($this->config->item('genre_list'));
        $this->load->process_view('story/suggesion_list', $this->arrStoryData);
        return;
    }

    /**
     * Function to get story title suggession list
     * @return type
     */
    public function getStarterSuggesion() {
        $this->arrStoryData['suggession'] = 'starter';
        $this->arrStoryData['arrSuggesionListByTitle'] = $this->Api->sendCurlRequest($this->config->item('story_list'));
        $this->arrStoryData['arrSuggesionListByGenre'] = $this->Api->sendCurlRequest($this->config->item('story_list'));
        $this->load->process_view('story/suggesion_list', $this->arrStoryData);
        return;
    }

    /**
     * Function to get story title suggession list
     * @return type
     */
    public function getTitleByGenre($strGenre) {
        $arrSuggesionTitleList = $this->Api->sendCurlRequest($this->config->item('title_suggestion'), '', '/' . $strGenre, 'GET');
        try {
            $arrTitle = array();
            foreach ($arrSuggesionTitleList as $key => $objData) {
                $arrTitle[] = $objData->Title;
            }
        } catch (FacebookApiException $e) {
            error_log($e);
        }

        print_r(json_encode(array('title' => count($arrTitle) ? $arrTitle[rand(0, count($arrTitle) - 1)] : 'No Title Found')));
        return;
    }

    /**
     * Function to respond a story request
     * @return type
     */
    public function respondToStoryRequest($isAccepted, $intNotificationID, $intStoryID) {
        $arrResponse = array();
        $objData = $this->Api->sendCurlRequest($this->config->item('respond_to_story_invitation'), '"' . $intStoryID . '"', '/' . $isAccepted . '/' . $intNotificationID . '');

        try {
            if (isset($objData->Error)) {
                $arrResponse['status'] = 'Error';
                $arrResponse['message'] = $objData->Error;
            } elseif ($objData->Response) {
                $arrResponse['status'] = 'Success';
                $arrResponse['message'] = $objData->Response;
            }
        } catch (FacebookApiException $e) {
            error_log($e);
        }

        print_r(json_encode($arrResponse));
        return;
    }

    public function addStoryInviteFriend() {
//$arrStoryData['arrStoryList'] = $this->Api->sendCurlRequest($this->config->item('story_list'));
        $this->load->template('story/add_invite_friend', $this->arrStoryData);
        return;
    }

}

/* End of file story.php */
/* Location: ./application/controllers/story.php */