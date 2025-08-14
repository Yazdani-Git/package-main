
     
        <div class="prb_list_body line_h30">
            <?php
           foreach($host_comments['ans_comment'] as $row){ ?>
            <div class="prb_list_item">
                <h3 class="fz13"><span class="fz13">نظر برای : </span><?php echo $row['post_name'] ?></h3>
                <p class="fz12"><?php echo $row['comment'] ?></p>

                <div class="w_answer">
                    <textarea class="w_answer_content"></textarea>
                </div>
                <div class="d_flex flex_jcend">
                    <span class="w_ans_submit " data-coid="<?php echo $row['id']  ?>">ثبت پاسخ</span>
                </div>
            </div>
            <?php   }
          ?>
        </div>