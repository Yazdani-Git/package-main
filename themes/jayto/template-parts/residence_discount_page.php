<script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
<script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>
<?php
 $args = array(
	'post_type'  => 'residence',
	'posts_per_page' => '-1',
);
$residance = get_posts( $args );
//print_r($residance)

?>
<div class="dis_item">
    <table class="width_100">
        <thead>
        <tr>
            <th>تصویر اقامتگاه</th>
            <th>نام اقامتگاه</th>
            <th>تاریخ شروع تخفیف</th>
            <th>تاریخ پایان تخفیف</th>
            <th>درصد تخفیف</th>
            <th>عملیات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($residance as $row){
          $image_url = get_the_post_thumbnail_url( $row->ID, 'thumbnail' );
          $meta = get_post_meta($row->ID,'_all_res_meta',true);
          $discount=$meta['discount'];
//print_r($discount)
            ?>

            <tr>
                <td>
                    <div class="dis_img">
                        <img src="<?php echo $image_url ?>">
                    </div>
                </td>
                <td>
                    <div class="red_dname">
                        <span><?php echo  $row->post_title ?></span>
                    </div>
                </td>
                <td>

                        <input type="text"  value="<?php echo $discount['start_date ']?>" class="start_date inp_style" autocomplete="off" placeholder="1402/05/01">


                    </div>

                </td>
                <td>

                        <input type="text"  value="<?php echo $discount['end_date']?>" class="end_date inp_style" autocomplete="off" placeholder="1402/05/02">


                    </div>
                </td>
                <td>
                    <div class="red_dname">
                        <input type="number" value="<?php echo $discount['perscent_discount']?>" class="inp_style perscent_discount" placeholder="عدد تخفیف به درصد وارد کنید">
                    </div>
                </td>
                <td>
                    <span class="submit_discount" data-did="<?php echo $row->ID ?>">ثبت تخفیف</span>
                </td>

            </tr>

     <?php   }
        ?>
        </tbody>
    </table>

</div>


