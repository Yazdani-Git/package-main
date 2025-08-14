<?php
$nots=get_user_meta($uid,'user_note',true);

?>

<div class="admin_add_wallet_box">
	<div class="aawb_head">

	</div>
	<div class="noti_desc">
        <label>متن پیام :</label>
		<textarea class="noti_body">

		</textarea>
        <span class="noti_send" data-id="<?php  echo $uid ?>">ارسال</span>
	</div>
	<div class="aawb_body">
		<div class="last_notification">

            <?php
            foreach ($nots as $key=>$row){ ?>
                    <div class="each_note">
                        <span><?php  echo $row?></span>
                        <span data-id="<?php echo $key?>" data-uid="<?php  echo $uid?>" class=" del_note dashicons dashicons-trash"></span>
                    </div>

          <?php  }
            ?>
		</div>
	</div>
</div>
