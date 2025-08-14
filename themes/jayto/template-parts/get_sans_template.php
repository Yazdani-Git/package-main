
<div class="room_item_box_prbox ">
	<p>
	<div class="added_aj_sans d_flex"></div>
	<div id="each_day_price d_flex ">
		<label class="mr5 mbt10">افزودن سانس </label>

		<div class="sans_box">
			<input type="text" value="" class="sans" autocomplete="off">
			<date-picker value="" type="datetime" display-format="jYYYY-jMM-jDD/HH:mm" format="jYYYY-jMM-jDD" custom-input=".sans"></date-picker>

			<span class="add_private_sans_submit" data-oid="<?php  echo $oid ?>">ذخیره</span>
		</div>
	</div>
	</p>
	<p>
</div>

<script>
    let app55 = new Vue({
        el: '.sans_box',
        data: {
            dates: '',
        },
        components: {
            DatePicker: VuePersianDatetimePicker
        }
    });
</script>