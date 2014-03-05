<div class="top_header_bar">
    <div class="div_header">Stories</div>

    <div class="btn-group add_friend">
        <button class="btn btn-warning" id="add_new_story" type="button">Add Story</button>
    </div>

    <div class="btn-group sorter">
        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
            Story Sort By <span class="caret"></span>
        </button>
        <ul role="menu" class="dropdown-menu pull-right spin_sorter">
            <li><a href="javascript:void(0);" sort="1" id="3">Most Recent</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="0" id="2">A-Z By Story Title</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="1" id="2">Z-A By Story Title</a></li>

        </ul>
    </div>
</div>
<?php //echo '<pre>'; print_r($this->session->userdata); ?>
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
            </tr>
        </thead>
        <tbody>
            <?php if (count($arrStoryList)): ?>
                <?php foreach ($arrStoryList as $key => $objStory): ?>
                    <tr>
                        <td class="hide"></td>
                        <td class="story_info td_large">
                            <span><?php echo $objStory->StoryTitle; ?></span>
                            <div class="decide_latter"><?php echo $objStory->Genre; ?></div> 
                        </td>
                        <td class="hide"><?php echo $objStory->StoryTitle; ?> </td>
                        <td class="hide"><?php echo strtotime($objStory->DateCreated); ?> </td>
                        <td class="user_info td_mid">
                            <img width="40" height="40" src="<?php echo empty($objStory->CreatedUserPicture) ? $this->config->item('user_image') : $objStory->CreatedUserPicture; ?>" alt="user">
                            <span class="midium_title">
                                <a href="<?php echo base_url() . 'friend/getUserDetails/' . $objStory->CreatedBy; ?>" target="_self">
                                    <?php echo ucwords($objStory->CreatedUserName); ?>
                                </a>
                            </span>
                        </td>
                        <td class="user_stories td_mid">
                            <div><?php echo ($objStory->IsComplete === true) ? 'Completed' : 'In-Progress'; ?></div> 
                            <div class="date_time"><?php echo date('M d, H:i a', strtotime($objStory->DateCreated)); ?></div>
                        </td>
                        <td class="story_like td_mid">
                            <div>
                                &nbsp;                            
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr class="spin_table_row">
                    <td colspan="5">No Story(s) Found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="display:<?php echo count($arrStoryList) > 10 ? 'block' : 'none'; ?>">
    <div class="bottom_footer_bar">
        <span total="<?php echo count($arrStoryList); ?>" cnt="<?php echo $this->config->item('page_count'); ?>" id="loading_more_text" class="loading_more_text">Loading....</span>
    </div>
    <div id="pager" class="pager">
        <form>
            <select id="current_pagesize" class="pagesize">
                <option selected="selected" value="<?php echo $this->config->item('page_count'); ?>"><?php echo $this->config->item('page_count'); ?></option>
            </select>
        </form>
    </div>
</div>