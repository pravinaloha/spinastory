<div class="table-responsive suggesion_list_table">
    <table id="myTable" class="tablesorter table table-striped friend_list">
        <tbody>
            <?php if ($suggession === 'title'): ?>
                <tr>
                    <td>
                        <div class="suggest_title">
                            <div class="add_new_story_form">
                                <form role="form">
                                    <div class="form-group" style="padding-top: 25px;">
                                        <label for="storytitle">Genre</label>
                                        <label style="margin-left: 20px;">
                                            <select id="genre_name">
                                                <option selected></option>
                                                <?php foreach ($arrSuggesionList as $key => $objGenre): ?>
                                                    <option value="<?php echo $objGenre->ID; ?>"><?php echo $objGenre->Genre; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <div class="spin_hand fl"></div>
                                        <div class="spin_here fl"></div>
                                        <div class="cf"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="storytitle" class="fl">Title</label>
                                        <input type="text" required class="form-control fl" id="storytitlesuggession" placeholder="">
                                        <div class="cf"></div>
                                    </div>
                                    <button type="button" class="btn btn-info suggest_title_ok" disabled="disabled">Ok</button>
                                </form>

                            </div>
                        </div>
                    </td>
                </tr>

            <?php elseif ($suggession === 'starter'): ?>
                <tr>
                    <td>
                        <div class="suggest_story">
                            <p>Suggest based on</p>
                            <div class="story_option">
                                <div class="btn-group" data-toggle="buttons">
                                    <label id="story_title" class="btn btn-primary active">
                                        <input type="radio" name="options" id="option1"> Story Title
                                    </label>
                                    <label id="story_genre" class="btn btn-primary">
                                        <input type="radio" name="options" id="option2">&nbsp;&nbsp; Genre &nbsp;&nbsp;
                                    </label>
                                </div>
                            </div>
                            <p></p>
                            <div class="form-group">
                                <input type="text" class="form-control fl" id="storysuggession_title" placeholder="">
                                <input type="text" class="form-control fl" style="display:none;" id="storysuggession_genre" placeholder="">
                            </div>
                            <span>Select a story starter</span>
                            <div class="story_suggesion_list">
                                <div class="storysuggession_title">
                                    <table id="myTable1" class="tablesorter table table-striped">
                                        <tbody>
                                            <?php if (count($arrSuggesionListByTitle)): ?>
                                                <?php foreach ($arrSuggesionListByTitle as $key => $objStory): ?>
                                                    <tr>
                                                        <td class="story_info td_large"><?php echo $objStory->StoryTitle; ?></td>
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
                                <div class="storysuggession_genre"  style="display:none;">
                                    <table id="myTable1" class="tablesorter table table-striped">
                                        <tbody>
                                            <?php if (count($arrSuggesionListByGenre)): ?>
                                                <?php foreach ($arrSuggesionListByGenre as $key => $objStory): ?>
                                                    <tr>
                                                        <td class="story_info td_large"><?php echo $objStory->StoryTitle; ?></td>
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
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
