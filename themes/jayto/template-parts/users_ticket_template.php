<?php
/* Template Name:Tickets */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

ob_start();
get_header( 'single' );
$header = ob_get_clean();
$site_name = get_bloginfo('name'); 
$title= $site_name.'-تیکت ها';
$header = preg_replace('#<title>(.*?)<\/title>#', '<title>'.$title.'</title>', $header);
echo $header;

$uid     = get_current_user_id();
$all_q   = [];
$all_a   = [];
$tickets = get_user_tickets( $uid );
if($tickets){
    foreach ( $tickets as $ticket ) {
        if ( $ticket['parent'] == 0 ) {
            $all_q[] = $ticket;
        } elseif ( $ticket['parent'] != 0 ) {
            $all_a[] = $ticket;
        }
    }
}

?>
<div class="profile_box">
    <?php
		if ( ! wp_is_mobile() ) { ?>
    <div class="prb_menu">

        <div class="prb_menu_body">
            <div class="prb_menu_section">
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'لیست سفرها و درخواست ها', 'jayto' ) ?></span>
                        <a href="<?php echo home_url(); ?>/trips"
                            class="fz10 fw300 col_gray mbt10 "><?php echo _e( 'سفرهای من', 'jayto' ) ?></a>
                        <?php
                            if ($tour_enable){ ?>
                        <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های
                            من</a>
                        <?php }
                            ?>
                        <?php
                            if ( $user_role == 'host' ) {
	                            ?>
                        <a href="<?php echo home_url(); ?>/host_request" class="fz10 fw300 col_gray mbt10 ">
                            <?php echo _e( 'درخواست ها', 'jayto' ) ?></a>

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
                        <span class="fz12 fw700 col_gray2 "><?php echo _e( 'اقامت گاه های من', 'jayto' ) ?></span>
                        <a href="<?php echo home_url(); ?>/my-host"
                            class="fz10 fw300 col_gray mbt10 "><?php echo _e( 'لیست اقامتگاه', 'jayto' ) ?> </a>
                        <a href="<?php echo home_url(); ?>/add-host"
                            class="fz10 fw300 col_gray mbt10 "><?php echo _e( 'ثبت اقامتگاه', 'jayto' ) ?> </a>
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
                        <a href="<?php echo home_url(); ?>/my-hotel" class="fz10 fw300 col_gray mbt10 ">لیست هتل ها </a>
                        <a href="<?php echo home_url(); ?>/add_hotel" class="fz10 fw300 col_gray mbt10 ">ثبت هتل </a>
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

                <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item">
                    <span class="prb_icon"><i class="fa fa-heart"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'موردعلاقه ها', 'jayto' ) ?></span>
                        <span
                            class="fz10 fw300 col_gray mbt10"><?php echo _e( 'لیست اقامتگاه های مورد علاقه', 'jayto' ) ?></span>

                    </div>
                </a>
            </div>
            <?php
					if ( $user_role != 'host' ) {
						?>
            <div class="prb_menu_section">
                <p class="fz10 fw300 col_gray mbt10"><?php echo _e( 'میزبانی اقامتگاه', 'jayto' ) ?></p>
                <a href="#" class="prb_menu_item cr-host">
                    <span class="prb_icon"><i class="fa fa-exchange "></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'میزبان شوید', 'jayto' ) ?></span>
                        <span
                            class="fz10 fw300 col_gray mbt10"><?php echo _e( 'همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد کنید.', 'jayto' ) ?></span>

                    </div>
                </a>
            </div>
            <?php }
					?>
            <div class="prb_menu_section">
                <p class="fz10 fw300 col_gray mbt10"><?php echo _e( 'حساب کاربری', 'jayto' ) ?></p>
                <a href="<?php echo home_url(); ?>/account" class="prb_menu_item active">
                    <span class="prb_icon"><i class="fa fa-user-alt"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'اطلاعات حساب کاربری', 'jayto' ) ?></span>
                        <span
                            class="fz10 fw300 col_gray mbt10"><?php echo _e( 'مشاهده و ویرایش حساب کاربری', 'jayto' ) ?></span>
                        <span class="line_dash mbt10"></span>
                    </div>

                </a>
                <a href="<?php echo home_url(); ?>/transaction" class="prb_menu_item">

                    <span class="prb_icon"><i class="fa fa-file-text "></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'تراکنش های من', 'jayto' ) ?></span>
                        <span
                            class="fz10 fw300 col_gray mbt10"><?php echo _e( 'مشاهده زمان و تاریخ تراکنش ها', 'jayto' ) ?></span>
                        <span class="line_dash mbt10"></span>
                    </div>
                </a>
                <a href="<?php echo home_url() ?>/password" class="prb_menu_item">
                    <span class="prb_icon"><i class="fa fa-key"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'رمز عبور', 'jayto' ) ?></span>
                        <span
                            class="fz10 fw300 col_gray mbt10"><?php echo _e( 'تنظیم و تغییر رمز عبور', 'jayto' ) ?></span>
                        <span class="line_dash mbt10"></span>
                    </div>
                </a>
                <div class="prb_menu_section">
                    <p class="fz10 fw300 col_gray mbt10"><?php echo _e( 'اعتبار', 'jayto' ) ?></p>
                    <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-wallet"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'کیف پول', 'jayto' ) ?></span>
                            <span
                                class="fz10 fw300 col_gray mbt10"><?php echo _e( 'موجودی،افزایش اعتبار', 'jayto' ) ?></span>

                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-ban"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'مسدود شده ها', 'jayto' ) ?></span>
                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'درخواست وجه', 'jayto' ) ?></span>


                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/wallet requests" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'لیست درخواست وجه', 'jayto' ) ?></span>


                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php }
		?>

    <div class="prb_content">
          
        <section class="profile_box_l_inner">
            <h3 class="profile-title">تیکت ها</h3>
            <div class="d_flex alignc">
                <i class="fa fa-edit ml_10 col_blue"></i>
                <span class="add_ticket_but mbt20">ثبت تیکت جدید</span>
            </div>


            <div class="add_new_ticket">
                <div class="ticket_error">
                    <ul></ul>
                </div>

                <form action="#" method="post" id="user_ticket" name="user_ticket" enctype="multipart/form-data">

                    <p><span class="fz12">موضوع :</span> <input type="text" class="ticket_subject"
                            name="ticket_subject"></p>


                    <p><span class="fz12">متن تیکت :</span><textarea class="ticket_desc" name="ticket_desc"></textarea>
                    </p>
                    <p><input type="hidden" name="parent_tic_uid" value="<?php  echo get_current_user_id();
                        ?>"></p>

                    <p><span class="fz12">ضمیمه ها</span><input class="ticket_upload" id="ticket_upload"
                            name="ticket_upload" type="file" multiple></p>


                    <p class=" addtsu"><input type="submit" class="ticket_submit" value="ثبت تیکت"></p>
                    <div class="form_ticket_error">

                    </div>

                    <div class="form_ticket_success">
                        <p>تیکت با موفقیت ارسال شد</p>
                    </div>
                </form>

            </div>
   
    <?php
                   
				foreach ( $all_q as $q ) {

					$send_date = $q['ticket_date'];
					?>
    <div class="user_tickets">
        <div class="user_ticket_send ">

            <p><span class="tid"> شماره تیکت : <?php echo $q['id'] ?></span></p>
            <p><span class="tis"> وضعیت تیکت :</span>
                <?php
								if ( $q['status'] == 0 ) {
									?>
                <span class="t_Survey">در حال بررسی</span>
                <?php }
								if ( $q['status'] == 1 ) {
									?>
                <span class="t_answered">پاسخ داده شده</span>
                <?php }
								?>
                <?php if ( $q['status'] == 2 ) { ?>
                <span class="t_close">بسته</span>
                <?php }
								?>


            </p>
            <p>تاریخ ثبت تیکت : <?php 
        
									$commentsdate1 = jdate( 'd-m-Y', strtotime($send_date), '', '', 'en' );
									echo $commentsdate1;
								 ?> </p>
            <p> موضوع : <?php echo $q['subject'] ?></p>
            <p> متن تیکت : <?php echo $q['description'] ?></p>
            <div class="utvb_div ">
                <i class="fal fa-eye" style="color: #00bdc4;"></i>
                <span class="user_tickets_view_bot">مشاهده پرسش و پاسخ ها</span>
            </div>

            <div class="user_tickets_view">

                <?php
								foreach ( array_reverse( $all_a ) as $a ) {
									if ( $a['parent'] == $q['id'] ) { ?>
                <div class="admin_answer <?php if ( $a['admin_status'] == 1 )
											echo 'admin_ans_back' ?>">
                    <p><?php if ( $a['admin_status'] == 1 )
													echo 'پاسخ ادمین:' ?> </p>

                    <p><?php echo $a['description'] ?></p>
                    <?php
	                                        $url = dt_url . '/';
	                                        if ($a['file_link']){?>
                    <a target="_blank" href="<?php  echo $a['file_link']; ?>">
                        <i class="dashicons dashicons-paperclip"></i>
                    </a>
                    <?php   }
	                                        ?>

                </div>
                <?php }
								}
								?>
                <div class="add_answer_to_admin_answer">
                    <?php
									if ( $a['status'] == 0 ) {
										?>

                    <p class="text_l"><span class="answer_to_answer_bot">درج پاسخ <i class="fas fa-reply-all"
                                style="color: #00bdc4;"></i></span></p>
                    <?php }

									?>

                    <div class="admin_answer_form_ans">
                        <form action="#" method="post" id="user_answet_ticket">


                            <p><span>پاسخ شما :</span></p>
                            <p><textarea class="ticket_desc_answer" name="ticket_desc_answer"></textarea></p>
                            <p class="po_rev"><span>فایل ضمیمه </span><input type="file" name="send_user_attach"
                                    class="send_user_attach"><span class="send_user_attach_before">انتخاب فایل</span>
                            </p>
                            <input class="naswer_to_answer_tid" type="hidden" value="<?php echo
											       $q['id'] ?>">
                            <div class="form_ticket_error">

                            </div>
                            <div class="form_ticket_success">
                                <p>تیکت با موفقیت ارسال شد</p>
                            </div>
                            <p class="text_l"><span class="answer_ticket_to_answer_submit">ارسال
                                    پاسخ<i class="fa fa-paper-plane" style="color: #00bdc4;"
                                        aria-hidden="true"></i></span>
                            </p>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <?php }
				?>



    </section>



</div>

</div>
</div>
<?php


get_footer();