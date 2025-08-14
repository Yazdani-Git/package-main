<div class="add_new_ticket">
    <div class="ticket_error">
        <ul></ul>
    </div>

    <form action="#" method="post" id="user_ticket" name="user_ticket" enctype="multipart/form-data">

        <p><span class="fz12">موضوع :</span> <input type="text" class="ticket_subject" name="ticket_subject"></p>


        <p><span class="fz12">متن تیکت :</span><textarea class="ticket_desc" name="ticket_desc"></textarea></p>
        <p><input type="hidden" name="parent_tic_uid" value="<?php  echo get_current_user_id();
                        ?>"></p>

        <p><span class="fz12">ضمیمه ها</span><input class="ticket_upload" id="ticket_upload" name="ticket_upload"
                type="file" multiple></p>


        <p class=" addtsu"><input type="submit" class="ticket_submit" value="ثبت تیکت"></p>
        <div class="form_ticket_error">

        </div>

        <div class="form_ticket_success">
            <p>تیکت با موفقیت ارسال شد</p>
        </div>
    </form>
</div>
