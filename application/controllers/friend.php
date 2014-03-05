<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Class for handling All Friend releated events
 * ===================================
 * Method List
 * =============
 * 1) index
 * 2) addFriend
 * 3) inviteFriend
 * 4) getUserDetails
 * 5) friendRequestList
 * 6) getFriendRequests
 * 7) addFriendFromFacebook
 * 8) respondToFriendRequest
 */
class Friend extends CI_Controller {

    public $arrFriendsData = array();

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * Index controller
     * @return type
     */
    public function index() {
        $strSearch = $this->input->post('search_box');

        if ($strSearch) {
            // Get all friend registered to spin a story
            $this->addFriend($strSearch);
            return;
        } else {
            // Get all friend registered to spin a story as per search critera
            $this->arrFriendsData['arrFriendList'] = $this->Api->sendCurlRequest($this->config->item('friend_list'));
        }

        $this->load->template('friend/friend_list', $this->arrFriendsData);
        return;
    }

    /**
     * Function to fetch all friend request list
     * @return type
     */
    public function friendRequestList() {
        $this->arrFriendsData['arrFriendRequestList'] = $this->Api->sendCurlRequest($this->config->item('friend_requests'));
        $this->load->template('friend/friend_request_list', $this->arrFriendsData);
        return;
    }

    /**
     * Function to add friend from spin a story
     * @return type
     */
    public function addFriend($strSearch = "") {

        $strSearch = $this->input->post('search_box');

        if ($strSearch) {
            // If user search friend then display friend list accordingly
            $this->arrFriendsData['arrFriendList'] = $this->Api->sendCurlRequest($this->config->item('friend_list_search'), '"' . $strSearch . '"');
        } else {
            // Return with no friend array to suggest for search a friend
            $this->arrFriendsData['arrFriendList'] = array();
        }

        $this->load->template('friend/add_friend', $this->arrFriendsData);
        return;
    }

    /**
     * Function to add friend from facebook
     * @return type
     */
    public function addFriendFromFacebook() {

        $arrUserProfile = null;

        // See if there is a user from a cookie
        $user = $this->facebook->getUser();

        if ($user) {
            try {

                //Get logged in user information.
                $arrMyProfile = $this->facebook->api('/me');

                // Get list of friends of loggedin  user.
                if (isset($arrMyProfile['id']) && $arrMyProfile['id']) {
                    $arrUserProfile = $this->facebook->api('/' . $arrMyProfile['id'] . '?fields=id,name,email,friends.fields(name,username)');
                }
            } catch (FacebookApiException $e) {
                error_log($e);
            }
        }

        $this->arrFriendsData['arrFriendList'] = $arrUserProfile['friends']['data'];

        $this->load->template('friend/add_facebook_friend', $this->arrFriendsData);
        return;
    }

    /**
     * Function to get Friens List from API
     * @return type
     */
    public function getFriendRequests() {
        $this->arrFriendsData['arrFriendRequestList'] = $this->Api->sendCurlRequest($this->config->item('friend_requests'));
        print_r(json_encode($this->arrFriendsData['arrFriendRequestList']));
        return;
    }

    /**
     * Function to invite Friens from Spin a story
     * @return type
     */
    public function inviteFriend($strInviteEmail) {
        $arrResponse = array();
        $objData = $this->Api->sendCurlRequest($this->config->item('invite_friend'), '"' . $strInviteEmail . '"');

        // If get error message
        if (isset($objData->Error)) {
            $arrResponse['status'] = 'Error';
            $arrResponse['message'] = $objData->Error;
        } elseif ($objData->Response) {
            // If get response from api
            $arrResponse['status'] = 'Success';
            $arrResponse['message'] = $objData->Response;
        }

        print_r(json_encode($arrResponse));
        return;
    }

    /**
     * Function to invite Friens from Spin a story
     * @return type
     */
    public function respondToFriendRequest($isAccepted, $intNotificationID, $intInvitationID) {
        $arrResponse = array();
        $objData = $this->Api->sendCurlRequest($this->config->item('respond_to_friend_request'), '"' . $intInvitationID . '"', '/' . $isAccepted . '/' . $intNotificationID . '');
        // If get error message
        if (isset($objData->Error)) {
            $arrResponse['status'] = 'Error';
            $arrResponse['message'] = $objData->Error;
        } elseif ($objData->Response) {
            // If get response from api
            $arrResponse['status'] = 'Success';
            $arrResponse['message'] = $objData->Response;
        }
        print_r(json_encode($arrResponse));
        return;
    }
    
    /**
     * Function to get user details by userid
     * @param type $intUserId
     * @return type
     */
    public function getUserDetails($intUserId) {
        $this->arrFriendsData['arrUserInfo'] = $this->Api->sendCurlRequest($this->config->item('user_details_by_user_id'), '', '/' . $intUserId . '');
        $this->arrFriendsData['arrUserStoryList'] = $this->Api->sendCurlRequest($this->config->item('story_list'), '"' . $intUserId . '"');
        $this->load->template('friend/user_details', $this->arrFriendsData);
        return;
    }

}

/* End of file friend.php */
/* Location: ./application/controllers/friend.php */