<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="top_header_bar">
    <div class="div_header">Stories</div>
    <div class="btn-group sorter">
        <button class="btn btn-warning" type="button">Story Sort By</button>
        <button data-toggle="dropdown" class="btn btn-warning dropdown-toggle" type="button">
            <span class="caret"></span>
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <ul role="menu" class="dropdown-menu pull-right spin_sorter">
            <li><a href="javascript:void(0);" sort="0" id="1">A-Z By Story Title</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="1" id="2">Z-A By Story Title</a></li>
            <li class="divider"></li>
            <li><a href="javascript:void(0);" sort="0" id="3">Golden Pens</a></li>
            <li class="divider"></li>
            <li><a  href="javascript:void(0);" sort="0" id="4">Progress</a></li>
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
            <?php foreach ($arrFriendList as $key => $arrFriend): ?>
                <tr>
                    <td></td>
                    <td class="">
                      <?php echo rand(1,7); ?>
                    </td>
                    <td class="">
                      <?php echo rand(1,7); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php if (count($arrFriendList) > 10): ?>
    <div class="bottom_footer_bar">
        <span total="<?php echo count($arrFriendList); ?>" cnt="<?php echo $this->config->item('page_count'); ?>" id="loading_more_text" class="loading_more_text">Load More</span>
    </div>
    <div id="pager" class="pager">
        <form>
            <select id="current_pagesize" class="pagesize">
                <option selected="selected" value="<?php echo $this->config->item('page_count'); ?>"><?php echo $this->config->item('page_count'); ?></option>
            </select>
        </form>
    </div>
<?php endif; ?>