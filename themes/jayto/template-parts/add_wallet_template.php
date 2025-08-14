<div class="prb_content_body">
    <div class="prb_wallet d_flex padd20">
        <div class="prbcb_right width55">

            <div class="wallet_price_box">
                <button class="wallet_button">
                    <span class="wl_price">50،000</span>
                    <input type="hidden" class="wl_price_inp" value="50000">
                    <span class="fz11 fw300">تومان</span>
                </button>
                <button class="wallet_button">
                    <span class="wl_price">100،000</span>
                    <input type="hidden" class="wl_price_inp" value="100000">
                    <span class="fz11 fw300">تومان</span>
                </button>
                <button class="wallet_button">
                    <span class="wl_price">150،000</span>
                    <input type="hidden" class="wl_price_inp" value="150000">
                    <span class="fz11 fw300">تومان</span>
                </button>
            </div>
            <div class="wallet_inp_box">
                <input type="number" name="up_wallet_amount" autocomplete="off" class=" up_wallet_amount wallet_inp" placeholder="مبلغ دلخواه را وارد کنید">
                <span class="fz11 fw300 mr5">تومان</span>
            </div>
            <span class="adm_add_wallet_submit">افزایش موجودی</span>
            <span class="adm_low_wallet_submit ml10">کاهش موجودی</span>
        </div>
        <div class="prbcb_left width45 d_flex">
            <div class="wallet_cart">
                <div class="wallet_logo">
					<?Php show_site_logo();

					?>
                </div>
                <span class="col_white"><?php echo get_bloginfo( 'url' ) ?></span>
                <div class="wallet_footer">
                    <span class="col_white fz13 fw700">موجودی کیف پول</span>
                    <div>
						<?php
						$amount = get_user_meta( $uid, 'jayto-wallet' );
						if ( $amount ) {
							$amount_ex = $amount[0];
						} else {
							$amount_ex = 0;
						}
						?>
                        <span class="col_white ml_10"><?php echo number_format( $amount_ex ) ?></span>&nbsp;<span class="col_white fw700 fz15 ">تومان</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
