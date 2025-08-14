
<style>
    .swiper {
        width: 100%;
        height: 100vh;
    }
    .swiper-button-next_r,
    .swiper-button-prev_r {
        background-color: white;
        background-color: rgba(255, 255, 255, 0.5);
        right:10px;
        padding: 30px;
        color: #000 !important;
        fill: black !important;
        stroke: black !important;
    }
    .swiper-slide {
        text-align: center;
        font-size: 18px;
        background: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
        height: 100%!important;
        object-fit: cover;
    }
    .swiper-button-next, .swiper-button-prev{

    }
</style>
<p class="padd10 d_flex justc_sb">
    <span>تصاویر اتاق <?php   echo $name ?></span>
    <span class="cupoint fz16">x</span>
</p>
<hr>
<div class="swiper swiper10 ">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
<?php

    foreach ( $urls as $row ) {
 	?>
   <div class="swiper-slide">
        <img src="<?php echo home_url().'/wp-content/uploads/'.$row ?>" alt="">
    </div>

<?php }
?>

    </div>

    <div class="swiper-pagination"></div>

    <div class="swiper-button-next"><span class="fa fa-chevron-right"></span></span></div>
    <div class="swiper-button-prev"><span class="fa fa-chevron-left"></span></div>

</div>
<script>
    var swiper = new Swiper(".swiper10", {
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        loop: true,
    });
</script>