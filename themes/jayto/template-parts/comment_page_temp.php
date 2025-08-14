<?php
/* Template Name:Comment Page Template */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

ob_start();
get_header( 'single' );
$header = ob_get_clean();
$site_name = get_bloginfo('name'); 
$title= $site_name.'-افزودن نظر';
$header = preg_replace('#<title>(.*?)<\/title>#', '<title>'.$title.'</title>', $header);
echo $header;
 $oi_arr=$_GET['riuid'];
 $oi_exp = explode('-',$oi_arr);
  $oi = $oi_exp[0]-6254765489;
 $res_id = $oi_exp[1]-54896564787;
 $post = get_post($res_id );
$info=get_order_by_id($oi);

?>
<div class="comment_pbox">
    <input type="hidden" class="oiidform" value="<?php  echo $oi_arr ?>-<?php echo $info->user_id  ?>">
    <h3 class="mr047 fz15 ">نظر خود را در مورد اقامت در <?php echo $post->post_title  ?> ثبت نمایید</h3>
    <div class="comment_container">
        <article class="coments_item">
            <div class="comments_inner">
                <div class="com_header ">
                    <p class="fz14 fw700 mbt10">مطابقت با آگهی</p>
                    <p class="fz12">اقامتگاه چقدر با مشخصات درج شده در سایت مطابقت داشت؟</p>
                </div>
                <div class="com_body mbt10 d_flex">
                    <div id="rating" class="rast Match_the_ad">

                    </div>
                </div>

            </div>
        </article>
        <article class="coments_item">
            <div class="comments_inner">
                <div class="com_header ">
                    <p class="fz14 fw700 mbt10">خدمات و سرویس دهی</p>
                    <p class="fz12">خدمات و سرویس دهی در چه وضعی بود؟</p>
                </div>
                <div class="com_body mbt10 d_flex">
                    <div id="rating1" class="rast Services">

                    </div>
                </div>

            </div>
        </article>
        <article class="coments_item">
            <div class="comments_inner">
                <div class="com_header ">
                    <p class="fz14 fw700 mbt10">موقعیت مکانی</p>
                    <p class="fz12">مطابقت موقعیت درج شده با موقعیت واقعی اقامتگاه؟ </p>
                </div>
                <div class="com_body mbt10 d_flex">
                    <div id="rating2" class="rast  res_Location">

                    </div>
                </div>

            </div>
        </article>
        <article class="coments_item">
            <div class="comments_inner">
                <div class="com_header ">
                    <p class="fz14 fw700 mbt10"> برخورد میزبان</p>
                    <p class="fz12">برخوردمیزبان با شما چطور بود؟</p>
                </div>
                <div class="com_body mbt10 d_flex">
                    <div id="rating3" class="rast res_encounter">

                    </div>
                </div>

            </div>
        </article>
        <article class="coments_item">
            <div class="comments_inner">
                <div class="com_header ">
                    <p class="fz14 fw700 mbt10"> نظافت</p>
                    <p class="fz12">نظافت اقامتگاه در چه سطحی بود؟</p>
                </div>
                <div class="com_body mbt10 d_flex">
                    <div id="rating4" class="rast cleaning">

                    </div>
                </div>

            </div>
        </article>
        <article class="coments_item">
            <div class="comments_inner">
                <div class="com_header ">
                    <p class="fz14 fw700 mbt10"> ارزش قیمت</p>
                    <p class="fz12">ارزش قیمت نسبت به اقامتگاه </p>
                </div>
                <div class="com_body mbt10 d_flex">
                    <div id="rating5" class="rast price">

                    </div>
                </div>

            </div>
        </article>
    </div>

</div>

</div>
</article>
</div>
<div class="add_comment_desc">
    <p class="mr047 fz15 mbt20 ">نظر خود را بنویسید</p>
    <textarea name="acdes" id="acdes" ></textarea>
</div>
<div class="acmbox">
<span class="acombtn">ثبت نظر</span>
</div>
</div>

<script>
var rating = {};

//Set the default icons
rating.selectedIcon = '<?php echo get_template_directory_uri()   ?>/images/unselectedStar.png';
rating.unselectedIcon = '<?php echo get_template_directory_uri()   ?>/images/selectedStar.png';
rating.defaultRating = 3;
rating.outOf = 5;
rating.name = 'rating';

rating.create = function(settings) {
    //Set the icons if they have been set
    this.selectedIcon = settings.selectedIcon || this.selectedIcon;
    this.unselectedIcon = settings.unselectedIcon || this.unselectedIcon;

    //Set both the outOf and defaultRatings
    this.defaultRating = settings.defaultRating || this.defaultRating;
    this.outOf = settings.outOf || rating.outOf;

    //Set the default name
    this.name = settings.name || rating.name;

    //Set the classes
    var ratingClass = settings.ratingClass || {};

    //Check whether the user is using font awesome
    var usingFa = false;
    var startingHtml = '<img src="';
    var subSelector = 'img';
    if (this.selectedIcon.substring(0, 3) == 'fa ' || this.unselectedIcon.substring(0, 3) == 'fa ') {
        usingFa = true;
        subSelector = 'i';
        startingHtml = '<i class="';
    }


    var html = '<input type="hidden" name="' + this.name + '" value="' + this.defaultRating + '">';
    //Create the ratings HTML
    for (var i = 0; i < this.defaultRating; i++) {
        html = html + startingHtml + this.selectedIcon + '" data-position="' + (i + 1) + '"';
        for (var x = 0; x < ratingClass.length; x++) {
            if (x === 0) {
                html = html + ' class="';
            }
            html = html + ratingClass[x];
            if (x + 1 == ratingClass.length) {
                html = html + '"';
            } else {
                html = html + ' ';
            }
        }
        html = html + '>';
        if (usingFa) {
            html = html + '</i>';
        }
    }
    for (var i = 0; i < this.outOf - this.defaultRating; i++) {
        html = html + startingHtml + this.unselectedIcon + '" data-position="' + (this.defaultRating + i + 1) +
        '">';
        if (usingFa) {
            html = html + '</i>';
        }
    }
    jQuery(settings.selector).html(html);
    jQuery(settings.selector + ' ' + subSelector).on('mouseover', function() {
        var position = jQuery(this).data('position');
        jQuery(settings.selector + ' ' + subSelector).each(function(i, e) {
            if (i < position) {
                jQuery(e).attr('src', rating.selectedIcon);
            } else {
                jQuery(e).attr('src', rating.unselectedIcon);
            }
        });
    });

    jQuery(settings.selector + ' ' + subSelector).on('mouseout', function() {
        var selected = jQuery(this).siblings('input[name=' + rating.name + ']').val();
        jQuery(settings.selector + ' ' + subSelector).each(function(i, e) {
            if (i < selected) {
                jQuery(e).attr('src', rating.selectedIcon);
            } else {
                jQuery(e).attr('src', rating.unselectedIcon);
            }
        });
    });

    jQuery(settings.selector + ' ' + subSelector).on('click', function() {
        jQuery(this).siblings('input[name=' + rating.name + ']').val(jQuery(this).data('position'));
    });
}
rating.create({
    'selector': '#rating',
    'outOf': 5,
    'defaultRating': 3,
  

});
rating.create({
    'selector': '#rating1',
    'outOf': 5,
    'defaultRating': 3,

});
rating.create({
    'selector': '#rating2',
    'outOf': 5,
    'defaultRating': 3,
});
rating.create({
    'selector': '#rating3',
    'outOf': 5,
    'defaultRating': 3,
});
rating.create({
    'selector': '#rating4',
    'outOf': 5,
    'defaultRating': 3,
});
rating.create({
    'selector': '#rating5',
    'outOf': 5,
    'defaultRating': 3,
});
</script>
<?php
get_footer();