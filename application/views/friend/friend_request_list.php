<div class="table-responsive">
    <div class="div_header">Friend Requests</div>
    <div class="friend_request_list">
        <table class="table table-striped friend_list">
            <tbody>
                <?php foreach (arrFriendRequestList as $key => $objFriendRequest): ?>
                    <tr>
                        <td class="user_image">
                            <img src="<?php echo empty($objFriendRequest->Picture) ? $this->config->item('user_image') : $objFriendRequest->Picture; ?>" alt="user">
                        </td>
                        <td class="user_info">
                            <span><?php echo $objFriendRequest->UserName; ?></span>
                            <p>
                                <button type="button" class="accept_btn"></button>
                                <button type="button" class="reject_btn"></button>
                            </p>
                        </td>
                        <td class="user_edit">
                            <div>
                                <?php echo $objFriendRequest->CountGoldenPens; ?>                          
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>       