<div class="top_header_bar">

    <div class="search_box">
        <div class="input-group">
            <form method="post" action="<?php echo $url = base_url() . $this->uri->uri_string(); ?>">
                <input name="search_box" type="text" class="form-control">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-default">Search</button>
                </span>
            </form>
        </div>
    </div>

    <div class="div_header">Friends</div>
    <div class="btn-group add_friend">
        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle" type="button"> 
            Add Friend <span class="caret"></span>
        </button>
        <ul role="menu" class="dropdown-menu pull-right spin_sorter">
            <li><a href="<?php echo base_url() . 'friend/addFriendFromFacebook'; ?>" target="_self">From Facebook</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo base_url() . 'friend/addFriend'; ?>" target="_self">Spin A Story</a></li>
        </ul>
    </div>
    <div class="btn-group sorter">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Friends Sort By <span class="caret"></span>
        </button>
        <ul role="menu" class="dropdown-menu pull-right spin_sorter">
            <li><a href="javascript:void(0);" sort="0" id="2">A-Z By Story Title</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="1" id="2">Z-A By Story Title</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="1" id="3">Golden Pens</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="1" id="4">Recently Active</a></li>
        </ul>
    </div>
</div>

<div class="table-responsive">

    <table id="myTable" class="tablesorter table table-striped friend_list">
        <thead style="display:none;">
            <tr>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
                <th class="header"></th>
            </tr>
        </thead>
        <?php if (count($arrFriendList)): ?>
            <?php foreach ($arrFriendList as $key => $arrFriend): ?>
                <tr class="spin_table_row" id="<?php echo $arrFriend->UserID; ?>">
                    <td class="hide"></td>
                    <td class="user_image td_small">
                        <img src="<?php echo empty($arrFriend->Picture) ? $this->config->item('user_image') : $arrFriend->Picture; ?>" alt="user">
                    </td>
                    <td class="hide"> <?php echo ucwords($arrFriend->Name); ?>           </td>
                    <td class="hide"><?php echo ucwords($arrFriend->CountGoldenPens); ?></td>
                    <td class="hide"><?php echo $arrFriend->LastSeen; ?></td>
                    <td class="user_info td_large">
                        <span>
                            <a href="<?php echo base_url() . 'friend/getUserDetails/' . $arrFriend->UserID; ?>" target="_self">
                                <?php echo ucwords($arrFriend->Name ? $arrFriend->Name : 'Unknown User'); ?>
                            </a>
                        </span>
                        <div><?php echo date('M d, H:i a', strtotime($arrFriend->LastSeen)); ?></div>
                    </td>
                    <td class="user_stories td_small">
                        <div><?php echo $arrFriend->TotalStories; ?> Stories</div> 
                    </td>
                    <td class="user_edit td_small">
                        <div>
                            <?php echo $arrFriend->CountGoldenPens; ?>                            
                        </div>
                    </td>
                    <td class="user_invite td_small">
                        <button class="btn btn-primary btn-sm spin_invite_button" <?php echo ($arrFriend->IsFriend ? 'disabled="disabled"' : ''); ?> email="<?php echo $arrFriend->UserEmail; ?>" type="button">Invite Friend</button>
                    </td>
                    <td>
                        <div class="hide spin_message">
                            <div class="spin_message_show"></div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr class="spin_table_row">
                <td colspan="10">No Friend(s) Found, Please search your friend.</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>
</div>       

<div style="display:<?php echo count($arrFriendList) > 10 ? 'block' : 'none'; ?>">
    <div class="bottom_footer_bar">
        <span total="<?php echo count($arrFriendList); ?>" cnt="<?php echo $this->config->item('page_count'); ?>" id="loading_more_text" class="loading_more_text">Loading....</span>
    </div>
    <div id="pager" class="pager">
        <form>
            <select id="current_pagesize" class="pagesize">
                <option selected="selected" value="<?php echo $this->config->item('page_count'); ?>"><?php echo $this->config->item('page_count'); ?></option>
            </select>
        </form>
    </div>
</div>
