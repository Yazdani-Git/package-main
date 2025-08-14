<?php
global $wpdb;
$result0 = array();
$result1 = array();
$result2 = array();
$result3 = array();
$all_result = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}jayto_request_wallet ORDER BY id DESC  ", object );

foreach ( $all_result as $key => $row) {

	if ( $row->pay_status == 0 ) {
		$result0[$key] = $row;
	}
	if ( $row->pay_status == 1 ) {
		$result1[$key] = $row;
	}
	if ( $row->pay_status == 2 ) {
		$result2[$key] = $row;
	}
	if ( $row->pay_status == 3 ) {
		$result3[$key] = $row;
	}
}


?>
<input type="hidden" class="cur_sts" value="<?php echo $result0->pay_status ?>">
<div class="rq_box">
    <div class="rb_header">

        <span class="adm_button bgcol_dark finc_ord active " data-os="0">در انتظارتایید <span class="tbullet"><?php echo sizeof( $result0 ) ?></span></span>
        <span class="adm_button bgcol_dark finc_ord" data-os="1">تایید شده  <span class="tbullet"><?php echo sizeof( $result1 ) ?></span></span>
        <span class="adm_button bgcol_dark finc_ord" data-os="2">در انتظار پرداخت  <span class="tbullet"><?php echo sizeof( $result2 ) ?></span></span>
        <span class="adm_button bgcol_dark finc_ord" data-os="3">پرداخت شده <span class="tbullet"><?php echo sizeof( $result3 ) ?></span></span>
        <div class="rq_body">
            <table class="rqb_table">
                <thead>
                <tr>
                    <th>ردیف</th>
                    <th>آیدی کاربر</th>
                    <th>نام کاربر</th>
                    <th>تاریخ درخواست</th>
                    <th>تاریخ واریز</th>
                    <th>مبلغ درخواست (تومان)</th>
                    <th> مشخصات کاربر</th>
                    <th> کد یکتای درخواست</th>
                    <th>درج پیام مدیریتی</th>
                    <th>تغییر وضعیت</th>
                    <th>اطلاعات حساب</th>
                </tr>
                </thead>
                <tbody>
				<?php
				$i = 1;
				foreach ( $result0 as $row ) {


					$user_info = get_userdata( $row->user_id );
					$u_fname   = $user_info->first_name;
					$u_lname   = $user_info->last_name;

					?>

                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row->user_id ?></td>
                        <td><?php echo $u_fname ?>&nbsp;<?php echo $u_lname ?></td>
                        <td><?php echo jdate( 'Y/m/d ', $row->request_date ) ?></td>

                        <td>
							<?php if ( $row->pay_date != 0 ) {
								echo jdate( 'Y/m/d', $row->pay_date );
							} else {
								echo '---';
							} ?>
                        </td>
                        <td><?php echo number_format($row->amount) ?></td>
                        <td><span>مشاهده</span></td>
                        <td><?php echo $row->pay_number ?></td>

                        <td><span class="adm_not_insert" data-ui="<?php echo $row->id ?>">درج/تغییر پیام</span></td>
                        <td><span class="adm_change_rw_status" data-ui="<?php echo $row->id ?>">تغییر وضعیت</span></td>
                        <td><span class="adm_view_uinf" data-uid9989="<?php echo $row->user_id + 100 ?>">مشاهده</span></td>
                    </tr>
					<?php $i ++;
				}

				?>

                </tbody>
            </table>
        </div>
    </div>

</div>
<div class="order_show_comp">

</div>