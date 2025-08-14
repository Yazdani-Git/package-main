<?php

?>
<div class="room_box">

    <div class="room_boxr">
        <div class="room_borto">
            <div class="fz13 fw700"><?php echo $row['room_name'] ?></div>
            <div class="room_items">
                <div class="d_flex alignc">

					<?php

					if ( $adult ) {
						?>
                        <span class="dfgp10 col_gray fw300"><i class="fa fa-user col_orng"></i><?php echo $adult ?> &nbsp; بزرگسال</span>
					<?php }
					if ( $sum_chield ) {
						?>
                        <span>&nbsp;، &nbsp;</span> <span class="dfgp10 col_gray fw300"><?php echo $sum_chield ?> کودک &nbsp; </span>
					<?php }
					?>
                    <span class="gdot"></span>
                </div>
                <div class="d_flex alignc">
                    <span class="dfgp10 col_gray fw300"><i class=" fas fa-hamburger col_orng"></i>
                        <?php
                        if ( $row['room_breackfast'] == 'on' ) {
	                        echo 'با صبحانه  ';
                        }
                        if ( $row['room_lunch'] == 'on' ) {
	                        echo '، نهار ';
                        }
                        if ( $row['room_Dinner'] == 'on' ) {
	                        echo '  ، شام';
                        }
                        if ( $row['room_breackfast'] == 'on' || $row['room_lunch'] == 'on' || $row['room_Dinner'] == 'on' ) {
	                        echo ' <span class="gdot"></span>';
                        }
                        ?>

                    </span>

                </div>
                <div class="dfgp10">
                    <span> قیمت برای هر شب</span>
					<?php
					if ( $discount_percent != 0 or $discount_percent != '' ) { ?>
                        <span class="fw700"> <?php echo number_format( round( ( $sum_room_price / $number_of_day ) - ( $sum_room_price / $number_of_day * $discount_percent / 100 ), 0 ) ) ?> تومان</span>

					<?php } else { ?>
                        <span class="fw700"> <?php echo number_format( round( $sum_room_price / $number_of_day, 0 ) ) ?> تومان</span>

					<?php }
					?>


                </div>

                <div class="dfgp10">

                    <div class="dfgp10">
						<?php
						if ( $row['room_single_bed'] != 0 && $row['room_single_bed'] != '' ) { ?>
                            <span class="fw700"> <?php echo $row['room_single_bed'] ?></span>
                            <span> تخت یک نفره</span>

						<?php }
						?>


                    </div>

                    <div class="dfgp10">
						<?php
						if ( $row['room_Double_bed'] != 0 && $row['room_Double_bed'] != '' ) { ?>

                            <span class="fw700"> <?php echo $row['room_Double_bed'] ?></span>
                            <span> تخت دو نفره</span>

						<?php }
						?>

                    </div>


                </div>

            </div>
        </div>
        <div class="room_borbu room_b_v">
            <div class="w80p">
				<?php

				if ( $row['r_short_desc'] != '' ) { ?>
                    <span><?php echo $row['r_short_desc'] ?></span>
				<?php }
				?>
            </div>
            <div>
                <?php
                if (count($row['urls']) > 0){ ?>
                    <span class="veiw_but" data-key="<?php  echo $rid ?>" data-hoi="<?php echo $hotel_id ?>">مشاهده تصاویر اتاق</span>
              <?php  }
                ?>
            </div>


        </div>
    </div>

    <div class="room_boxl">
        <div class="room_bolto">
            <div class="hotel_dis_price">
				<?php
				if ( $discount_percent != 0 or $discount_percent != '' ) {

					?>


                    <del class="fz12  col_light"><?php echo number_format( $sum_room_price ) ?> </del>
                    <span class="hdis_badg mr_10"><?php echo $discount_percent ?></span>
				<?php } ?>
            </div>
            <div class="room_boltod">

                <span class="ml_10">قیمت برای <?php echo $number_of_day ?> شب</span>
				<?php
				if ( $discount_percent != 0 or $discount_percent != '' ) { ?>
                    <span><?php echo number_format( $sum_room_price - ( $sum_room_price * $discount_percent / 100 ) ) ?></span>
				<?php } else { ?>
                  <div class="hot_pri_box">  <span class="hotprc"><?php echo number_format( $sum_room_price ) ?>&nbsp;</span><span class="hotcur">تومان</span></div>
				<?php } ?>


            </div>
        </div>
        <div class="room_bolbu">
            <a href="<?php echo home_url() ?>/hotel-request?hoi=<?php echo $hotel_id ?>&adult_num=<?php echo $adult ?>&child=<?php echo $sum_chield ?>&roid=<?php echo $rid ?>&check_in=<?php echo $date_in ?>&check_out=<?php echo $date_out ?>&pci=<?php echo $sum_room_price ?>&pass_num=<?php echo $sum_chield + $adult ?>"
               class="hr_reserve_btn">رزرو اتاق</a>

        </div>
    </div>
</div>
<div class="room_slider_box">



   <div class="sw_room_slide">

   </div>

</div>