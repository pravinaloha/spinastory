<div class="top_header_bar">
    <div class="div_header">Notifications</div>
    <div class="btn-group sorter">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Notifications Sort By <span class="caret"></span>
        </button>
        <ul role="menu" class="dropdown-menu pull-right spin_sorter">
            <li><a href="javascript:void(0);" sort="0" id="1">A-Z By Story Title</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="1" id="1">Z-A By Story Title</a></li>
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
            </tr>
        </thead>
        <tbody>
            <?php if (count($arrNotificationList)): ?>
                <?php foreach ($arrNotificationList as $key => $objNotification): ?>
                    <tr>
                        <td></td>
                        <td class="user_image td_small">
                            <img src="<?php echo empty($objNotification->FromPicture) ? $this->config->item('user_image') : $objNotification->FromPicture; ?>" alt="user">
                        </td>
                        <td class="user_info td_xl">
                            <span><?php echo ucwords($objNotification->FromName); ?></span> has completed  <span><?php echo $objNotification->StoryTitle; ?></span> story.
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="spin_table_row">
                    <td colspan="3">No Notification(s) Found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<div style="display:<?php echo count($arrNotificationList) > 10 ? 'block' : 'none'; ?>">
    <div class="bottom_footer_bar">
        <span total="<?php echo count($arrNotificationList); ?>" cnt="<?php echo $this->config->item('page_count'); ?>" id="loading_more_text" class="loading_more_text">Loading....</span>
    </div>
    <div id="pager" class="pager">
        <form>
            <select id="current_pagesize" class="pagesize">
                <option selected="selected" value="<?php echo $this->config->item('page_count'); ?>"><?php echo $this->config->item('page_count'); ?></option>
            </select>
        </form>
    </div>
</div>