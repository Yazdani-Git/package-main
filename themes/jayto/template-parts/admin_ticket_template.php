<?php
$tickets       = get_nun_answer_ticket();
$answer_ticket = get_all_answer_tickets();
?>

<div id="admin_qa">
        <table>
            <thead>
            <tr>
                <td>ردیف</td>
                <td> کاربر</td>
                <td>تاریخ ثبت </td>
                <td>موضوغ تیکت</td>
                <td>متن تیکت</td>
                <td> ضمیمه</td>
                <td>وضعیت</td>
                <td>پاسخ</td>

            </tr>
            </thead>
            <tbody>

			<?php
			$i = 1;

			foreach ( $tickets as $row ) {
				$stat = $row['status'] ?>
				<?php

				?>

                <tr class="admin_row_tr">
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['uid'] ?></td>
                    <td>
						<?php if ( function_exists( 'parsidate' ) ) {
							$ticket_date = $row['ticket_date'];
							$qdate       = parsidate( 'd-M-Y', $ticket_date, 'per' );
						}
						echo $qdate ?>

                    </td>
                    <td><?php echo $row['subject'] ?></td>
                    <td><?php echo $row['description'] ?></td>
                    <td>
						<?php
						if ($row['file_link']){?>
                            <a href="<?php echo $row['file_link'] ?> " target="_blank"><i class="dashicons dashicons-paperclip"></i></a>
						<?php }else{
							echo "----";
						}
						?>


                    </td>

                    <td class="tss"><select id="ticket_select_status">

                            <option value="0" <?php if ( $row['status'] == '0' ) {
								echo 'selected=selected';
							} ?>>در حال
                                بررسی
                            </option>
                            <option value="1" <?php if ( $row['status'] == '1' ) {
								echo 'selected=selected';
							} ?>>پاسخ
                                داده شده
                            </option>

                            <option value="2" <?php if ( $row['status'] == '2' ) {
								echo 'selected=selected';
							} ?>>بسته
                            </option>

                        </select>
                        <input type="hidden" class="ticket_id" value="<?php echo $row['id']; ?>">

                    </td>

                    <td><span class="ticket_answer_but">مشاهده</span>
                <tr class="ticket_answer_tr">
                    <td class="ticket_answer" colspan="8">
						<?php
						?>
                        <p><?php echo $row['description'] ?></p>


                        </p>
						<?php ?>

						<?php
						foreach ( $answer_ticket as $ans_to_ans ) {
							if ( $ans_to_ans['parent'] == $row['id'] ) {

								?>

								<?php ?>
                                <div class="admin_answer_parent <?php  if ($ans_to_ans['admin_status'] != 1)echo 'admin_ans_back'?>">
                                    <p class="admin_ticket_user">
                                <span><?php if ($ans_to_ans['admin_status'] == 1)  echo 'پاسخ ادمین:' ?><?php if
	                                ($ans_to_ans['admin_status'] != 1)  echo 'پاسخ کاربر:' ?></span> <?php
										echo
										$ans_to_ans['description']; ?>

										<?php
										$url = dt_url . '/';
										if ($ans_to_ans['file_link']){?>
                                            <a target="_blank" href="<?php  echo $ans_to_ans['file_link']; ?>" >
                                                <i class="dashicons dashicons-paperclip"></i>
                                            </a>
										<?php   }
										?>

                                    </p>

									<?php ?>



                                </div>

							<?php }
						}
						?>
						<?php
						if($ans_to_ans['status'] ==0){?>

                            <div class="admin_answer_div ">
                                <p class="admin_tick_answer_p"><span class="admin_tick_answer">ارسال پاسخ</span></p>
                                <div class="admin_answer-ticket_form">

                                    <textarea class="admin_answer_text"></textarea>
                                    <p class="admin_send_file_box"><input type="file" class="admin_ans_file"></p>
                                    <p class="ctaml"><span class="insert_ticket_answer ">ثبت پاسخ</span></p>
                                    <input type="hidden" class="ticket_uid" value="<?php
									echo $row['uid']; ?>">
                                    <input type="hidden" class="ticket_id"
                                           value="<?php echo $row['id']; ?>">
                                </div>
                            </div>

						<?php  }
						?>
                    </td>


                </tr>
				<?php
				foreach ( $answer_ticket as $ans ) {
					if ( $ans['parent'] == $row['id'] ) {
						?>
                        <tr class="ticket_answer_tr">
                            <td class="ticket_answer" colspan="7">
								<?php
								?>
                                <p class="admin_ticket_admin"><span>پاسخ شما:</span> <?php echo $ans['description']; ?>
                                <div class="admin_answer-ticket_form">
                                    <textarea class="admin_answer_text"></textarea>
                                    <p><span class="insert_ticket_answer">ثبت پاسخ</span></p>
                                    <input type="hidden" class="ticket_uid" value="<?php
									echo $ans['uid']; ?>">
                                    <input type="hidden" class="ticket_id"
                                           value="<?php echo $ans['id']; ?>">
                                </div>
                                </p>
								<?php ?>

								<?php
								foreach ( $answer_ticket as $ans_to_ans ) {
									if ( $ans_to_ans['parent'] == $ans['id'] ) {

										?>

										<?php ?>
                                        <p class="admin_ticket_user">
                                            <span>پاسخ کاربر:</span> <?php echo $ans_to_ans['description']; ?></p>
										<?php ?>


                                        <div class="admin_answer-ticket_form">
                                            <textarea class="admin_answer_text"></textarea>
                                            <p><span class="insert_ticket_answer">ثبت پاسخ</span></p>
                                            <input type="hidden" class="ticket_uid" value="<?php
											echo $row['uid']; ?>">
                                            <input type="hidden" class="ticket_id"
                                                   value="<?php echo $ans_to_ans['id']; ?>">
                                        </div>


									<?php }
								}
								?>

                            </td>


                        </tr>


					<?php }
				}
				?>




				<?php $i ++;
			};
			?>


            </tbody>
        </table>
    </div>