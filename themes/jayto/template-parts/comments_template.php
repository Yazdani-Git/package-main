<?php
if(count($com )> 0){

  ?>
<span class="line_dash margin_tb40"></span>
<h3 class="d_flex mbt20">
    <img class="w18px" src="<?php echo get_template_directory_uri()  ?>/images/UnselectedStar.png" alt="UnselectedStar">
    <span class="fz14 ml_10"> <?php echo number_format($all_star_sum, 1, '.', '')/count($com)  ?> </span>
    <span class="fz14">( <?php echo count($com)  ?> بازخورد )</span>
</h3>
<div class="comment_report">
    <div class="comr_item">
        <span class="fz11">تطابق با آگهی</span>
        <div class="comr_result">
            <span class="fz10 fw300">5</span>
            <span class="fz11 fw700"> /<?php  echo number_format($Match_the_ad_ave, 1, '.', '')   ?></span>

        </div>
    </div>
    <div class="comr_item">
        <span class="fz11">سرویس دهی</span>
        <div class="comr_result">
            <span class="fz10 fw300">5</span>
            <span class="fz11 fw700"> / <?php  echo number_format($Services_ave, 1, '.', '')    ?></span>

        </div>
    </div>
    <div class="comr_item">
        <span class="fz11">موقعیت مکانی</span>
        <div class="comr_result">
            <span class="fz10 fw300">5</span>
            <span class="fz11 fw700"> / <?php  echo number_format($res_Location_ave, 1, '.', '')   ?></span>

        </div>
    </div>
    <div class="comr_item">
        <span class="fz11">نحوه میزبانی</span>
        <div class="comr_result">
            <span class="fz10 fw300">5</span>
            <span class="fz11 fw700"> / <?php  echo number_format($res_encounter_ave, 1, '.', '')  ?></span>

        </div>
    </div>
    <div class="comr_item">
        <span class="fz11">نظافت</span>
        <div class="comr_result">
            <span class="fz10 fw300">5</span>
            <span class="fz11 fw700"> / <?php  echo number_format($cleaning_ave, 1, '.', '')  ?></span>

        </div>
    </div>
    <div class="comr_item">
        <span class="fz11">ارزش قیمت</span>


        <div class="comr_result">
            <span class="fz10 fw300">5</span>
            <span class="fz11 fw700">/<?php  echo $price_ave  ?></span>

        </div>
    </div>
</div>
<div class="comments_container">
    <?php }
if($com){
foreach($com as $row){
    $user= get_user_by('id',$row->user_id);
    $user_image = get_user_meta( $user->id, 'user_profile_imsge' );
    $author_id = get_post_field( 'post_author', $row->res_id );
    $hoster_image = get_user_meta( $author_id, 'user_profile_imsge' );
   $author_name = get_the_author_meta( 'first_name' , $author_id );
    if($row->confirm == 1){ ?>
    <article class="coments_item">
        <div class="comments_inner">
            <div class="com_header d_flex">
                <?php
if($user_image){ ?>
                <img src="<?php echo $user_image[0] ?>" alt="user-profile">
                <?php }else{ ?>
                <img src="<?php echo get_template_directory_uri()  ?>/images/user-profile.png" alt="user-profile">

                <?php } ?>
                <div class="comh_desc">
                    <?php
if($user->user_nicename){ ?>
                    <h3 class="fz11"><?php echo $user->first_name  ?>&nbsp(مهمان)</h3>
                    <?php }else{ ?>
                    <h3 class="fz11">مهمان</h3>
                    <?php }
              ?>

                    <span class="fz11"><?php  echo $row->comment_date ?></span>
                </div>
            </div>
            <div class="com_body mbt10 d_flex">
                <p class="fz11 fw400  line_h30"> <?php  echo $row->comment ?></p>
            </div>
            <!-- <span class="com_mor fz12 d_flex">مشاهده بیشتر</span> -->
        </div>
  <?php
if($row->admin_answer){ ?>
      <div class="com_header  hoans_box">

<div class="comh_desc d_flex alignc">
    <?php
      if($hoster_image){ ?>
    <img src="<?php echo  $hoster_image[0] ?>" alt="user-profile">

    <?php  }else{?>
    <img src="<?php echo get_template_directory_uri()  ?>/images/user-profile.png" alt="user-profile">
    <?php  }
  ?>
    <h3 class="fz11"><?php echo $author_name   ?> (میزبان)</h3>

</div>
</div>
<div class="com_body mbt10 d_flex">
<p class="fz11 fw400  line_h30"> <?php  echo $row->admin_answer ?></p>
</div>
<?php }
  ?>
    </article>
    <?php  }
    ?>



    <?php }
} 
?>
</div>