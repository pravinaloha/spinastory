// Global array

var listNotifications = {
    1: ' has send friend request for ',
    2: ' has accepted friend request for ',
    3: ' has send story request for ',
    4: ' has accepted story request for creating ',
    5: ' has added story text for ',
    6: ' has completed ',
    7: ' has rejected friend request for ',
    8: ' has rejected story request for '
};
var response = [];
var inviteType;

/**
 * Object to display message on top
 * @type type
 */
var objMessage = $('.spin_header_message');

$(document).ready(function() {

    $("#myTable").tablesorter({headers: {0: {sorter: false}}}).tablesorterPager({container: $("#pager"), size: page_count ? page_count : 10});

    $("html, body").animate({scrollTop: 0}, "slow");

    displayNotifications();
    //displayFriendRequests();

    $(".notification-bubble").click(function() {
        $("#notification").toggleClass('hide');
        hideMe($("#friend"));
        hideMe($("#story"));
    });
    // Display(toggle) friend request on click
    $(".friend-bubble").click(function() {
        $("#friend").toggleClass('hide');
        hideMe($("#notification"));
        hideMe($("#story"));
    });

    // Display(toggle) story request on click
    $(".story-bubble").click(function() {
        $("#story").toggleClass('hide');
        hideMe($("#notification"));
        hideMe($("#friend"));
    });

    // Display(toggle) friend request on click
    $(".show_friends").click(function() {
        $("#friends").toggle();
    });

    // add new story
    $("#add_new_story").click(function() {
        window.location = base_url + 'story/addNewStory';
    });

    // solo story 
    $(".write_solo").click(function() {
        inviteType = 'solo';
        $('.story_submit').trigger('click');
    });

    //collaborate  story
    $(".collaborate").click(function() {
        inviteType = 'collaborate';
        $('.story_submit').trigger('click');
    });

    $('#genre_name').live('change', function() {
        $('#genrename').val($("#genre_name :selected").text());
        $('#genreid').val($(this).val());
        $('#genre_name_last').val($(this).val());
    });


    $('.genre_name_change').live('click', function() {
        $('#genrename').val($("#genre_name_last :selected").text());
        $('#genreid').val($('#genre_name_last').val());
        $('#genre_name').val($('#genre_name_last').val());
    });

    //Check story private or public
    $(".is_private").live('click', function() {
        $('#publish_type').val($(this).attr('status'));
    });

    // Spin a story get random title
    $(".spin_here").live('click', function() {
        var strGenre = $('#genreid').val();
        var response = getAjax('story/getTitleByGenre/' + strGenre);
        $('#storytitlesuggession').val(response.title);
        $('.suggest_title_ok').removeAttr('disabled');
    });

    // assign a story get random title
    $(".suggest_title_ok").live('click', function() {
        $('#storytitle').val($('#storytitlesuggession').val());
        $('.suggesion_list_table').addClass('hide');
    });


    // Display title suggession(s)
    $("#title_suggesion").click(function() {
        var response = getAjax('story/getTitleSuggesion');
        var objSuggesionList = $('.suggesstion_list');
        objSuggesionList.html(response.html);
    });

    // Display title suggession(s)
    $(".sugession_title").live('click', function() {
        var strSuggesion = $(this).html();
        $('#storytitle').val(strSuggesion);
    });

    // Display title suggession(s)
    $(".sugession_starter").live('click', function() {
        var strSuggesion = $(this).html();
        $('#storycontent').val(strSuggesion);
    });

    // Display title suggession(s)
    $("#starter_suggesion").click(function() {
        var response = getAjax('story/getStarterSuggesion');
        var objSuggesionList = $('.suggesstion_list');
        objSuggesionList.html(response.html);

        $('#storysuggession_title').val($('#storytitle').val());
        $('#storysuggession_genre').val($('#genrename').val());
    });

    //Toggle radio button for Story Starter
    $('#story_title').live('click', function() {
        $('#storysuggession_title').show();
        $('#storysuggession_genre').hide();
        $('.storysuggession_title').show();
        $('.storysuggession_genre').hide();
    });

    //Toggle radio button for Story Starter
    $('#story_genre').live('click', function() {
        $('#storysuggession_title').hide();
        $('#storysuggession_genre').show();
        $('.storysuggession_title').hide();
        $('.storysuggession_genre').show();
    });

    // Move story suggession into TextArea
    $('.story_suggesion_list td').live('click', function() {
        $('#storycontent').val($(this).html());
    });


    // Move story suggession into TextArea
    $('.editstory').live('click', function() {
        $('.add_story_invite').removeClass('hide');
        $('.complete_story_invite').addClass('hide');
    });

    // Move story suggession into TextArea
    $('.complete_story').live('click', function() {
        $('.add_story_invite').addClass('hide');
        $('.complete_story_invite').removeClass('hide');
    });



//    //When user click outsite notifications
//    $(document).click(function(event) {
//        if ($(event.target).parents().index($('#notification')) === -1) {
//            if ($('#notification').css("display") === "block") {
//                $("#notification").hide();
//            }
//        }
//    });

    // Display(toggle) friend request on click
    $(".accept_button").live('click', function() {
        var strIds = $(this).attr('id');
        var strRequestType = $(this).attr('rq');
        var isAccept = $(this).attr('accept');
        parsedTest = JSON.parse(strIds); //an array [1,2]

        var intNotificationId = parsedTest[0];
        var intInviteId = parsedTest[1];
        var response;
        if (strRequestType === 'story')
            response = getAjax('story/respondToStoryRequest/' + (isAccept ? 'true' : 'false') + '/' + intNotificationId + '/' + intInviteId);
        else
            response = getAjax('friend/respondToFriendRequest/' + (isAccept ? 'true' : 'false') + '/' + intNotificationId + '/' + intInviteId);

        objMessage.html(response.message);

        if (response.status === 'Success') {
            objMessage.addClass('spin_success');
            showMe(objMessage);
            objMessage.delay(2000).fadeOut('slow',
                    function() {
                        objMessage.html('');
                        if (strRequestType === 'story') {
                            $('#story_' + intNotificationId).remove();
                            $('.story-bubble').html(parseInt($('.story-bubble').html() - 1));
                        }
                        else {
                            $('#friend_' + intNotificationId).remove();
                            $('.friend-bubble').html(parseInt($('.story-bubble').html() - 1));
                        }
                    });
            return false;
        }
        else {
            objMessage.addClass('spin_error');
            showMe(objMessage);
            objMessage.delay(2000).fadeOut('slow',
                    function() {
                        objMessage.html('');
                    });
        }

    });


    // Display(toggle) friend request on click
    $(".spin_invite_button").live('click', function() {
        var response = getAjax('friend/inviteFriend/' + $(this).attr('email'));

        objMessage.html(response.message);
        showMe(objMessage);

        if (response.status === 'Success') {
            $(this).attr('disabled', 'disabled');
            objMessage.addClass('spin_success');
            objMessage.delay(2000).fadeOut('slow',
                    function() {
                        objMessage.html('');
                    });
        }
        else {
            objMessage.addClass('spin_error');
            objMessage.delay(2000).fadeOut('slow',
                    function() {
                        objMessage.html('');
                    });

        }
    });


//    setInterval(function() {
//        displayNotifications();
//    }
//    , 50000, true);
//    

    // Detect that we are at bottom of page, and call autoloading function
    var killScroll = false; // IMPORTANT
    $(window).scroll(function() { // IMPORTANT
        if ($(window).scrollTop() >= ($(document).height() - ($(window).height() + 5))) { // IMPORTANT
            var total_records = parseInt($('.loading_more_text').attr('total'));
            var page_count = parseInt($('#page_count').attr('val'));
            var current_page_count = parseInt($('#loading_more_text').attr('cnt'));

            if (current_page_count < total_records)
            {
                $('#loading_more_text').attr('cnt', current_page_count + page_count);
                $(".pagesize option:selected").val(current_page_count + page_count).trigger('change');
            }
            else {
                $('.bottom_footer_bar').hide();
            }
        }
    });


    $(".spin_sorter a").live("click", function() {

        var id = parseInt($(this).attr('id'));
        var sort = parseInt($(this).attr('sort'));

        //console.log(id);
        // console.log(sort);

        var sorting;

        if (sort)
        {
            sorting = [[id, 1]];
        }
        else
        {
            sorting = [[id, 0]];
        }
        //$(".spin_sorter").hide();
        $("#myTable").trigger("sorton", [sorting]);
        $(".div_header").trigger("click");

        return false;
    });

    $(".noti_delete").live("click", function() {
        var strId = $(this).attr('id');
        var id = strId.split('_');
        $("#noti_" + id[1]).fadeOut("slow");
        $("#noti_" + id[1]).remove();
        var intNotificationCnt = parseInt($('.notification-bubble').html());
        $('.notification-bubble').html(intNotificationCnt - 1);
        setNotification();
    });

    $(".friend_delete").live("click", function() {
        var strId = $(this).attr('id');
        var id = strId.split('_');
        $("#friend_" + id[1]).fadeOut("slow");
        $("#friend_" + id[1]).remove();
        var intNotificationCnt = parseInt($('.friend-bubble').html());
        $('.friend-bubble').html(intNotificationCnt - 1);
        setFriends();
    });


    var screenTop = $(document).scrollTop();
    $('.loading_image').css('top', screenTop / 2);


});

/**
 * Function to set notifications
 * @returns {undefined}
 */
function setNotification()
{
    // alert($(".notification > div").length);
    if ($(".notification > div").length > 6) {
        $(".notification").addClass('scroll_me');
        $(".show_all_notifications").show();
    }
    else {
        $(".notification").removeClass('scroll_me');
        $(".show_all_notifications").hide();
    }

}

/**
 * Function to set Friends
 * @returns {undefined}
 */
function setFriends()
{
    // alert($(".notification > div").length);
    if ($(".friend > div").length > 6) {
        $(".friend").addClass('friends_scroll_me');
        $(".show_all_friends").show();
    }
    else {
        $(".friend").removeClass('friends_scroll_me');
        $(".show_all_friends").hide();
    }

}

/**
 * Function to show progress while get ajax response
 * @returns {undefined}
 */
function showProgress() {
    $('body').append('<div id="progress"><img src="' + base_url + 'images/loading.gif" alt="" width="16" height="11" /> Loading...</div>');
    $('#progress').center();
}

/**
 * Function to hide progress after ajax respnose get
 * @returns {undefined}
 */
function hideProgress() {
    $('#progress').remove();
}


jQuery.fn.center = function() {
    this.css("position", "absolute");
    this.css("top", ($(window).height() - this.height()) / 2 + $(window).scrollTop() + "px");
    this.css("left", ($(window).width() - this.width()) / 2 + $(window).scrollLeft() + "px");
    return this;
};

/**
 * Function to get Ajax response 
 * @param {type} url
 * @returns {undefined}
 */
function getAjax(url)
{
    var result = "";
    $.ajax({
        type: 'GET',
        url: base_url + url,
        dataType: "json",
        data: {},
        async: false,
        cache: false,
        success: function(responseData)
        {
            result = responseData;

        }, error: function(error)
        {
            console.log(error);
        }
    });

    return result;
}

/**
 * Function to display notifications onn 
 * @returns {undefined}
 */
function displayNotifications()
{
    $.get(base_url + "notification/getAlerts", function(response) {

        var obj = jQuery.parseJSON(response);

        var strNotificationHtml = '';
        var strFriendHtml = '';
        var strStoryHtml = '';


        jQuery.each(obj, function(index, objNotification) {

            var cnt = $.map(objNotification, function(n, i) {
                return i;
            }).length;

            switch (index)
            {
                case 'notification':

                    $('.notification-bubble').html(cnt);

                    jQuery.each(objNotification, function(i, objNoti) {

                        var id = objNoti.NotificationID;

                        strNotificationHtml +=
                                '<div class="notifications_Request" id="noti_' + id + '">' +
                                '<div class="cf"></div>' +
                                '<div class="noti_image"><img src="' + processImage(objNoti.FromPicture) + '" alt="Image" /></div>' +
                                '<div class="my_notifications" id="' + id + '"><span>' + capitalize(objNoti.FromName) + '</span>' + listNotifications[objNoti.Type] + '<span> ' + objNoti.StoryTitle + '</span> story.</div>' +
                                '<div class="noti_delete" id="del_' + id + '"></div><div class="cf"></div></div>';
                    });

                    $('.notification').html(strNotificationHtml);

                    break;

                case 'friend':

                    $('.friend-bubble').html(cnt);

                    jQuery.each(objNotification, function(i, objFriend) {

                        var intFriendId = objFriend.NotificationID;

                        strFriendHtml +=
                                '<div class="friend_Request" id="friend_' + intFriendId + '">' +
                                '<div class="cf"></div>' +
                                '<div class="friend_image"><img src="' + processImage(objFriend.Picture) + '" alt="user image" /></div>' +
                                '<div class="my_notifications"><span>' + capitalize(objFriend.FromName) + '</span>' + listNotifications[objFriend.Type] + '<span> ' + objFriend.StoryTitle + '</span> story.</div>' +
                                '<button  id="[' + intFriendId + ',' + objFriend.InvitationID + ']" accept="1" rq="notification" type="button" class="btn btn-primary accept_button btn-xs">Accept</button>' +
                                '<button  id="[' + intFriendId + ',' + objFriend.InvitationID + ']" accept="0" rq="notification" type="button" class="btn btn-default accept_button btn-xs">Decline</button>' +
                                '<div class="cf"></div></div>';
                    });

                    $('.friend').html(strFriendHtml);

                    break;

                case 'story':
                    $('.story-bubble').html(cnt);

                    jQuery.each(objNotification, function(i, objStory) {

                        var id = objStory.NotificationID;

                        strStoryHtml +=
                                '<div class="notifications_Request" id="story_' + id + '">' +
                                '<div class="cf"></div>' +
                                '<div class="noti_image"><img src="' + processImage(objStory.FromPicture) + '" alt="Image" /></div>' +
                                '<div class="my_notifications"><span>' + capitalize(objStory.FromName) + '</span>' + listNotifications[objStory.Type] + '<span> ' + objStory.StoryTitle + '</span> story.</div>' +
                                '<button  id="[' + id + ',' + objStory.StoryID + ']" accept="1" rq="story" type="button" class="btn btn-primary accept_button btn-xs">Accept</button>' +
                                '<button  id="[' + id + ',' + objStory.StoryID + ']" accept="0" rq="story" type="button" class="btn btn-default accept_button btn-xs">Decline</button>' +
                                '<div class="cf"></div></div>';
                    });

                    $('.story').html(strStoryHtml);

                    break;
            }


            $('.notification-bubble').css('top', '11px');
            $('.friend-bubble').css('top', '11px');
            $('.story-bubble').css('top', '11px');
            setTimeout(function() {
                $('.notification-bubble').css('top', '17px');
                $('.friend-bubble').css('top', '17px');
                $('.story-bubble').css('top', '17px');
            }, 300);
        });
    });
}

/**
 * Function to process image ... If no image found at desire location apply local image.
 * @param {type} url
 * @returns {String}
 */
function processImage(url)
{
    image = new Image();
    image.src = url;

    if (image.width)
        return url;
    else
        return base_url + 'images/user.jpeg';
}

function capitalize(s)
{
    return s[0].toUpperCase() + s.slice(1);
}

function addNewStory() {
    $('.add_new_story_form').addClass('hide');
    $('.suggesion_list_table').addClass('hide');
    if (inviteType === 'solo')
    {
        $('.add_story_invite').removeClass('hide');
    }
    else {
        $('.add_story_step_first').addClass('hide');
        $('.friend_suggesion_list').removeClass('hide');
    }
    return false;
}

/**
 * Function to hide an object
 * @param {type} obj
 * @returns {undefined}
 */
function hideMe(obj) {
    obj.addClass('hide');
}

/**
 * Function to display an object
 * @param {type} obj
 * @returns {undefined}
 */
function showMe(obj) {
    obj.removeClass('hide');
}
