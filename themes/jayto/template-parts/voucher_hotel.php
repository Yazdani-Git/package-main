<?php
/* Template Name:voucher */
if ( ! defined( 'ABSPATH' ) ) {
exit; // Exit if accessed directly.
}

ob_start();
get_header( 'single' );
$oid = $_GET['vid']-25;
$order=get_hotel_order_by_id( $oid );
$hotel_info = get_post($order->hot_id);
$hotel_additional = get_post_meta($order->hot_id,'all_hotel_meta',true);
$hotel_room_a =$hotel_rooms    = get_post_meta( $order->hot_id, 'rooms_info', true );
$hotel_room =$hotel_rooms    =$hotel_room_a[$order->room_id];
$tr= get_transaction($order->user_id);
$all_pip =$order->adult_number+$order->adult_number->child_number;

?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <!-- بارگذاری کتابخانه html2canvas -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<div id="voucher-container">
    <div class="voucher-header">
        <h1>واچر رزرو هتل</h1>

        <div class="voucher-number">
            <p> شماره سفارش :<?php echo $order->id ?></p>
            <p>وضعیت پرداخت:
		        <?php
		        if ($order->order_status == 10) {
			        echo 'پرداخت شده';
		        }
		        ?>
            </p>

        </div>
    </div>

    <div class="hotel-info">
        <h2><?php  echo $hotel_info -> post_title ;?></h2>
        <p>آدرس هتل : <?php  echo $hotel_additional['address'] ;?></p>
        <p> تلفن هتل:  <?php  echo $hotel_additional['phone'] ;?></p>
    </div>



    <table class="voucher-table">
        <thead>
        <tr>
            <th>نام مهمان</th>
            <th>نام اتاق</th>
            <th>تاریخ ورود</th>
            <th>تاریخ خروج</th>
            <th>مدت اقامت</th>
            <th>تعداد نفرات</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?php echo $tr[0]['passenger_name'] ?>  <?php echo $tr[0]['passenger_famili']?></td>
            <td><?php  echo $hotel_room['room_name']?></td>
            <td><?php  echo $order->check_in?></td>
            <td><?php  echo $order->check_out?></td>
            <td> <?php  echo sizeof(get_beetween_date($order->check_in, $order->check_out))?></td>
            <td><?php  echo $all_pip ?></td>
        </tr>

        </tbody>
    </table>


</div>
<div class="sav_par">
    <button id="saveAsPdf">ذخیره</button>
</div>


    <script>
        // اطمینان از بارگذاری صفحه و جاوااسکریپت
        window.onload = function() {
            document.getElementById('saveAsPdf').addEventListener('click', function() {
                // اطمینان از وجود jsPDF در window
                const { jsPDF } = window.jspdf;

                // ایجاد یک شیء jsPDF جدید
                const doc = new jsPDF();

                // گرفتن اسکرین‌شات از محتوای HTML با html2canvas
                html2canvas(document.getElementById('voucher-container')).then(function(canvas) {
                    const imgData = canvas.toDataURL('image/png'); // تبدیل اسکرین‌شات به تصویر

                    const imgWidth = 210; // عرض PDF
                    const pageHeight = 297; // ارتفاع PDF
                    const imgHeight = canvas.height * imgWidth / canvas.width; // ارتفاع متناسب تصویر
                    let heightLeft = imgHeight;

                    let position = 0;

                    doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight); // اضافه کردن تصویر به PDF
                    heightLeft -= pageHeight;

                    // اگر محتوا بیش از یک صفحه باشد
                    while (heightLeft >= 0) {
                        position = heightLeft - imgHeight;
                        doc.addPage();
                        doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;
                    }

                    // ذخیره PDF
                    doc.save('<?php    echo $hotel_info->post_title;?>  ?>واچر.pdf');
                }).catch(function(error) {
                    console.error("خطا در گرفتن اسکرین‌شات: ", error);
                });
            });
        };
    </script>
<?php
get_footer();
