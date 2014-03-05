<div class="top_header_bar">
    <div class="div_header">Story</div>
</div>

<div class="table-responsive add_story_step_first">
    <table id="story_table" class="tablesorter table table-striped story_table">
        <tbody>
            <tr>
                <td class="add_story">
                    <div class="add_new_story_form">
                        <form role="form" onSubmit="return addNewStory();">
                            <div class="form-group">
                                <label for="storytitle">Title</label>
                                <input type="text" required class="form-control" id="storytitle" placeholder="Enter Title">
                                <input type="hidden" id="genrename" />
                                <input type="hidden" id="genreid" />
                                <input type="hidden" id="titleid" />
                                <input type="hidden" id="publish_type" value="true" />
                                <button type="button" id="title_suggesion" class="btn btn-link">Want a Suggestion?</button>
                            </div>
                            <div class="form-group">
                                <label for="storycontent">Start Your Story</label>
                                <textarea required class="form-control" id="storycontent" placeholder="(Upto 250 character only.)" rows="7"></textarea>
                                <button type="button" id="starter_suggesion" class="btn btn-link">Want a Story Starter?</button>
                            </div>
                            <button class="btn btn-warning story_submit hide" type="submit">1Collaborate</button>
                            <button class="btn btn-warning collaborate" type="button">Collaborate</button>
                            <button class="btn btn-warning write_solo" type="button">Write Solo</button>
                        </form>
                    </div>
                    <div class="add_story_invite hide">
                        <div class="story_header">
                            <div><label>Author</label></div>
                            <div><img src="https://graph.facebook.com/<?php echo $this->session->userdata('id'); ?>/picture" alt="<?php echo $this->session->userdata('name'); ?>" /></div>
                            <div class="author1_status"></div>
                            <div><label><?php echo $this->session->userdata('name'); ?></label></div>
                        </div>
                        <div class="cf"></div>
                        <div class="story_body">
                            <textarea class="form-control" id="authorstorycontent"  rows="10"></textarea>
                        </div>
                        <div class="story_bottom">
                            <button type="button" class="btn btn-warning complete_story">Complete</button>
                        </div>
                    </div>
                    <div class="complete_story_invite hide">
                        <div>
                            <button class="btn btn-warning editstory" type="button">Edit & Review Story</button>
                        </div>
                        <div>
                            <label for="storytitle">Genre</label>
                            <label>
                                <select id="genre_name_last">
                                    <option selected="selected"></option>
                                    <?php foreach ($arrSuggesionList as $key => $objGenre): ?>
                                        <option value="<?php echo $objGenre->ID; ?>"><?php echo $objGenre->Genre; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="button" class="btn btn-info genre_name_change">Change</button>
                            </label>
                        </div>
                        <div>
                            <label class="fl">Keep Story Private</label>
                            <div class="btn-group" data-toggle="buttons" style="width:100px; margin: 0px 0px 0px 20px;">
                                <label id="story_title" status="true" class="btn btn-primary active is_private">
                                    <input type="radio" name="options" > On
                                </label>
                                <label id="story_genre" status="false" class="btn btn-primary is_private">
                                    <input type="radio" name="options">Off
                                </label>
                            </div>  
                        </div>
                        <div class="publish_buttons">
                            <button type="button" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-warning">Publish Story</button>
                            <button type="button" class="btn btn-info facebook_publish">Publish To Facebook</button>
                        </div>
                    </div>
                </td>
                <td class="story_partition"></td>
                <td class="suggesstion_list"></td>
            </tr>
        </tbody>
    </table>
</div>


<div class="friend_suggesion_list hide">
    <div class="table-responsive">
        <table id="myTable" class="tablesorter table table-striped friend_list">
            <tbody>
                <?php if (count($arrFriendList)): ?>
                    <?php foreach ($arrFriendList as $key => $arrFriend): ?>
                        <tr>
                            <td class="hide"></td>
                            <td class="user_image td_small">
                                <img src="<?php echo empty($arrFriend->Picture) ? $this->config->item('user_image') : $arrFriend->Picture; ?>" alt="user">
                            </td>
                            <td class="hide"><?php echo ucwords($arrFriend->Name); ?> </td>


                            <td class="hide"><?php echo ucwords($arrFriend->CountGoldenPens); ?></td>
                            <td class="hide"><?php echo $arrFriend->LastSeen; ?></td>
                            <td class="user_info td_large">
                                <span>
                                    <a href="<?php echo base_url() . 'friend/getUserDetails/' . $arrFriend->UserID; ?>" target="_self">
                                        <?php echo ucwords($arrFriend->Name); ?>
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
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr class="spin_table_row">
                        <td colspan="8">No Friend(s) Found.</td>
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
</div>

