<?php
/* Template Name:Host Comments */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
global $current_user;                     
get_header( 'single' );
$tour_enable = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
$rol     = jayto_get_current_user_role();
 $user_id = $current_user->id;

if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
	$user_role = 'host';
}
$post_of_author =[];
$args = array(
  'author'        =>  $user_id, 
  'order'         =>  'ASC',
  'fields'=>'id',
  'post_type'        => 'any',
  'posts_per_page' => -1 // no limit
);
$current_user_posts = get_posts( $args );

foreach($current_user_posts as $row){
    $post_of_author[]=$row->ID;
}

$trasaction = get_transaction( $user_id );
$res_id_imp = implode('-',$post_of_author);
?>

<div class="profile_box">

    <?php

		if ( ! wp_is_mobile() ) { ?>
    <div class="prb_menu">
        <input type="hidden" class="cup_hid" value= " <?php  echo $res_id_imp ?>   ">
        <div class="prb_menu_body">
            <div class="prb_menu_section">
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2">لیست سفرها و درخواست ها</span>
                        <a href="<?php echo home_url(); ?>/trips" class="fz11 fw300 col_gray mbt10 ">سفرهای من</a>
                        <?php
                               if ($tour_enable){ ?>
                        <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های
                            من</a>
                        <?php }
                               ?>
                        <?php
                            if ( $user_role == 'host' ) {
	                            ?>
                        <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 "> درخواست
                            ها</a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">  درخواست های رزرو تور</a>
                        <?php }
                            ?>

                        <span class="line_dash mbt10"></span>
                    </div>
                </span>
                <?php
						if ( $user_role == 'host' ) {
							?>
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                    <div class="prb_menu_container active">
                        <span class="fz12 fw700 col_gray2 ">اقامت گاه های من</span>
                        <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 ">لیست اقامتگاه
                        </a>
                        <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 ">ثبت اقامتگاه
                        </a>
                        <span class="line_dash mbt10"></span>
                    </div>
                </span>
                <?php
							$allow_add_hotel = get_option( 'allow_add_hotel' );
							if ( $allow_add_hotel == 1 ) { ?>
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class=" fas fa-hotel"></i></span>
                    <div class="prb_menu_container active">
                        <span class="fz12 fw700 col_gray2 ">هتل های من</span>
                        <a href="<?php echo home_url(); ?>/my-hotel" class="fz11 fw300 col_gray mbt10 ">لیست هتل ها </a>
                        <a href="<?php echo home_url(); ?>/add_hotel" class="fz11 fw300 col_gray mbt10 ">ثبت هتل </a>
                        <span class="line_dash mbt10"></span>
                    </div>
                </span>
                <?php }
							?>
                <?php
							if ($allow_add_tour_hoster == 1){ ?>
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-tree"></i></span>
                    <div class="prb_menu_container active">
                        <span class="fz12 fw700 col_gray2 ">تجربه های من</span>
                        <a href="<?php echo home_url(); ?>/my-experiences" class="fz11 fw300 col_gray mbt10 ">لیست تجربه
                            ها </a>
                        <a href="<?php echo home_url(); ?>/add_experiences" class="fz11 fw300 col_gray mbt10 ">ثبت تجربه
                        </a>
                        <span class="line_dash mbt10"></span>
                    </div>
                </span>
                <?php    }
							?>
                <?php }
						
                        ?>
                <?php
                  if ( $user_role == 'host' ) { ?>
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class="fas fa-comment"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'نظرات و تیکت ها', 'jayto' ) ?></span>
                        <a href="<?php echo home_url(); ?>/host_comment" class="fz10 fw300 col_gray mbt10 ">
                            <?php echo _e( 'نظرات', 'jayto' ) ?></a>
                        <a href="<?php echo home_url(); ?>/user_ticket" class="fz10 fw300 col_gray mbt10 ">
                            <?php echo _e( 'تیکت پشتیبانی', 'jayto' ) ?></a>
                        <span class="line_dash mbt10"></span>
                    </div>
                </span>
                <?php } ?>
                <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-heart"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2">موردعلاقه ها</span>
                        <span class="fz11 fw300 col_gray mbt10">لیست اقامتگاه های مرد علاعق</span>

                    </div>
                </a>
            </div>
            <?php
					if ( $user_role != 'host' ) {
						?>
            <div class="prb_menu_section">
                <p class="fz11 fw300 col_gray mbt10">میزبانی اقامتگاه</p>
                <a href="#" class="prb_menu_item cr-host">
                    <span class="prb_icon"><i class="fa fa-exchange "></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2">میزبان شوید</span>
                        <span class="fz11 fw300 col_gray mbt10">همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد
                            کنید.</span>

                    </div>
                </a>
            </div>
            <?php }
					?>
            <div class="prb_menu_section">
                <p class="fz11 fw300 col_gray mbt10">حساب کاربری</p>
                <a href="<?php echo home_url(); ?>/account" class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-user-alt"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2">اطلاعات حساب کاربری</span>
                        <span class="fz11 fw300 col_gray mbt10">مشاهده و ویرایش حساب کاربری</span>
                        <span class="line_dash mbt10"></span>
                    </div>

                </a>
                <a href="<?php echo home_url(); ?>/transaction" class="prb_menu_item active">

                    <span class="prb_icon"><i class="fa fa-file-text "></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2">تراکنش های من</span>
                        <span class="fz11 fw300 col_gray mbt10">مشاهده زمان و تاریخ تراکنش ها</span>
                        <span class="line_dash mbt10"></span>
                    </div>
                </a>
                <a href="<?php echo home_url() ?>/password" class="prb_menu_item">
                    <span class="prb_icon"><i class="fa fa-key"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2">رمز عبور</span>
                        <span class="fz11 fw300 col_gray mbt10">تنظیم و تغییر رمز عبور</span>
                        <span class="line_dash mbt10"></span>
                    </div>
                </a>
                <div class="prb_menu_section">
                    <p class="fz11 fw300 col_gray mbt10">اعتبار</p>
                    <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item op7">
                        <span class="prb_icon"><i class="fas fa-wallet"></i></span>

                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">کیف پول</span>
                            <span class="fz11 fw300 col_gray mbt10">موجودی،افزایش اعتبار</span>

                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-ban"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">مسدود شده ها</span>
                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">درخواست وجه</span>


                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/wallet requests" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">لیست درخواست وجه</span>


                        </div>
                    </a>
                    <a href='<?php echo home_url(); ?>/user note' class='prb_menu_item '>
                        <span class='prb_icon'><i class="fa-solid fa-envelope"></i></span>
                        <div class='prb_menu_container'>
                            <span class='fz12 fw700 col_gray2'><?php echo _e( 'پیام ها', 'jayto' ) ?></span>
                            <span

                                    class='fz10 fw300 col_gray mbt10'><?php echo _e( 'مشاهده پیام های مدیریتی', 'jayto' ) ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php }
		?>


    <div class="prb_content">
        <?php
        
        $host_comments= get_comments_by_hoster($post_of_author);
     
       ?>
        <div class="prb_list_header">
            <ul>
                <li class=" active fz13 noAnswer_comment" data-inp="noAnswer_comment" >درانتظار پاسخ<span class="count_buble"><?php echo ($host_comments['all_comment_count']- $host_comments['no_ans_count']); ?></span></li>
                <li class=" fz13 answered_comment" data-inp="answered_comment">پاسخ داده شده<span class="count_buble"><?php echo $host_comments['no_ans_count']; ?></span></span></li>
            </ul>
        </div>
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




    </div>

</div>

<?php
get_footer();