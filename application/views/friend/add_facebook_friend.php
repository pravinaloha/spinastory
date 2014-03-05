
<div class="top_header_bar">
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
            </tr>
        </thead>
        <?php if (count($arrFriendList)): ?>
            <?php foreach ($arrFriendList as $key => $arrFriend): ?>
                <tr class="spin_table_row" id="<?php echo $arrFriend['id']; ?>">
                    <td class="hide"></td>
                    <td class="user_image td_small">
                        <img src="https://graph.facebook.com/<?php echo $arrFriend['id']; ?>/picture" alt="user">
                    </td>
                    <td class="hide"><?php echo ucwords($arrFriend['name']); ?></td>
                    <td class="user_info td_xl">
                        <span><?php echo ucwords($arrFriend['name']); ?></span>
                        <div><?php //echo date('M d, H:i a', strtotime($arrFriend->LastSeen));      ?></div>
                    </td>
                    <td class="user_invite td_small">
                        <button class="btn btn-primary btn-sm spin_invite_button" email="<?php echo isset($arrFriend['username']) ? $arrFriend['username'] : 'user'; ?>@facebook.com" type="button">Invite Friend</button>
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
                <td colspan="10">
                   

                </td>
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