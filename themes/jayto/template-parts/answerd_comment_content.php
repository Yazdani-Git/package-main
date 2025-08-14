
     
        <div class="prb_list_body line_h30">
            <?php
           foreach($host_comments['ans_comment'] as $row){ ?>
            <div class="prb_list_item">
                <h3 class="fz13"><span class="fz13">نظر برای : </span><?php echo $row['post_name'] ?></h3>
                <p class="fz12"><?php echo $row['comment'] ?></p>

                <div class="w_answer answer_box">
                    <p lass="fz12 d_flex"> پاسخ شما :<span>
                <p class="fz12"><?php echo $row['admin_answer'] ?></p>
                </div>
            
            </div>
            <?php   }
          ?>
        </div>