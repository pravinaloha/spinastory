<div class="top_header_bar">
    <div class="div_header">About</div>
</div>

<div class="friend_info">
    <div class="table-responsive">
        <table id="myTable" class="tablesorter table">
            <tbody>
                <tr>
                    <td rowspan="3"><img src="<?php echo $arrUserInfo->Picture; ?>" alt="<?php echo $arrUserInfo->Name; ?>" width="200" height="200" ></td>
                    <td colspan="2" class="user_info bl"><span><?php echo $arrUserInfo->Name; ?></span></td>
                </tr>
                <tr>
                    <td class="bl"><?php echo $arrUserInfo->TotalStories; ?> Stories</td>
                    <td> <div class="golden_pen"><?php echo $arrUserInfo->CountGoldenPens; ?></div></td>
                </tr>
                <tr>
                    <td colspan="2" class="bl">
                        <div>
                            <?php echo $arrUserInfo->Description; ?> 
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="div_header">Stories</div>

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
            </tr>
        </thead>
        <tbody>
            <?php if (count($arrUserStoryList)): ?>
                <?php foreach ($arrUserStoryList as $key => $objStory): ?>
                    <tr>
                        <td></td>
                        <td class="story_info">
                            <span><?php echo $objStory->StoryTitle; ?></span>
                            <div class="decide_latter"><?php echo $objStory->Genre; ?></div> 
                        </td>
                        <td class="user_info">
                            <img width="40" height="40" src="<?php echo empty($objStory->CreatedUserPicture) ? $this->config->item('user_image') : $objStory->CreatedUserPicture; ?>" alt="user">
                            <span class="midium_title">
                                <a href="<?php echo base_url() . 'friend/getDetails/' . $objStory->CreatedBy; ?>" target="_self">
                                    <?php echo ucwords($objStory->CreatedUserName); ?>
                                </a>
                            </span>
                        </td>
                        <td class="user_stories">
                            <div><?php echo ($objStory->IsComplete === true) ? 'Completed' : 'In-Progress'; ?></div> 
                            <div class="date_time"><?php echo date('M d, H:i a', strtotime($objStory->DateCreated)); ?></div>
                        </td>
                        <td class="story_like">
                            <div>
                                <?php echo $objStory->TotalVotes; ?>                           
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

<div style="display:<?php echo count($arrUserStoryList) > 10 ? 'block' : 'none'; ?>">
    <div class="bottom_footer_bar">
        <span total="<?php echo count($arrUserStoryList); ?>" cnt="<?php echo $this->config->item('page_count'); ?>" id="loading_more_text" class="loading_more_text">Loading....</span>
    </div>
    <div id="pager" class="pager">
        <form>
            <select id="current_pagesize" class="pagesize">
                <option selected="selected" value="<?php echo $this->config->item('page_count'); ?>"><?php echo $this->config->item('page_count'); ?></option>
            </select>
        </form>
    </div>
</div>
