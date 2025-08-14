<style>
#wpbody-content {
    min-height: 100vh;
}
</style>
<?php
   $cou=get_comment_counts();
?>
<div class='admin_comment_head'>
    <ul class='d_flex gap10'>
        <li class="noConfirmStatus">در انتظار تایید<span class="com_bullet"><?php echo $cou[0]  ?><span></li>
        <li class="ConfirmStatus">تایید شده<span class="com_bullet"><?php echo $cou[1]  ?><span></li>
    </ul>
</div>
<?php
if ( $comments ) {

    ?>
<div class='rq_body'>
    <table class='rqb_table'>

        <thead>
            <tr>
                <th class='w5p'>ردیف</th>
                <th>متن نظر</th>
                <th class='w5p'>وضعیت</th>
                <th class='w5p'>عملیات</th>

            </tr>
        </thead>
        <tbody>

            <?php
    $i = 1;
    foreach ( $comments as $row ) {
        ?>
            <tr>
                <td><?php echo $i  ?></td>
                <td class='w20p'><?php  echo substr( $row->comment, 0, 100 );
        ?></td>
                <td class='w20p'>
                    <?php
        if ( $row->confirm == 1 ) {
            echo 'تایید شده';
        } else {
            echo 'درانتظار تایید';
        }
      
        ?>
                </td>
                <td class='w20p'>
                    <span class='edit_comment ecom_but ' data-order='edit' data-id="<?php  echo $row->id ?>">مشاهده
                        / ویرایش</span>
                    <span class='conf_comment ceitm' data-order='confirm' data-id="<?php  echo $row->id ?>">تایید</span>
                    <span class='rej_comment ceitm' data-order='reject' data-id="<?php  echo $row->id ?>">رد</span>
                    <span class='del_comment ceitm' data-order='delete' data-id="<?php  echo $row->id ?>">حذف</span>

                </td>
            <tr class='slide_comment'>
                <td colspan='5' data-id="<?php  echo $row->id ?>">
                    <div><textarea class='show_all_comment' name='show_all_comment' cols='30'
                            rows='5'><?php echo $row->comment  ?></textarea></div>
                    <span class='com_text_save'>ذخیره</span>
                </td>
            </tr>
            </tr>

            <?php $i++;
    }
    ?>
        </tbody>
    </table>
</div>

</tbody>
</table>
</div>
<?php }

    ?>

<div class='ca_box'>
    <span class='ca_box_close'><i class='dashicons dashicons-no-alt'></i></span>