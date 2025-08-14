<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<div class="crb_head">
    <p id="message"></p>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError, {enableHighAccuracy: true});

            } else {
                document.getElementById("message").innerHTML = "مرورگر شما از این قابلیت پشتیبانی نمی‌کند.";
            }
        }

        function showPosition(position) {
            var lat = position.coords.latitude;
            var lon = position.coords.longitude;

            // ارسال داده‌های لوکیشن به سرور با استفاده از POST
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'latitude=' + lat + '&longitude=' + lon
            })
                .then(response => response.text())
                .then(data => {
                    document.getElementById("message").innerHTML = data;
                });
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById("message").innerHTML = "دسترسی به لوکیشن رد شد. لطفاً لوکیشن را فعال کنید.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById("message").innerHTML = "اطلاعات لوکیشن در دسترس نیست.";
                    break;
                case error.TIMEOUT:
                    document.getElementById("message").innerHTML = "درخواست لوکیشن زمان‌بندی شد.";
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById("message").innerHTML = "یک خطای ناشناخته رخ داده است.";
                    break;
            }
        }
    </script>
    <p><?php echo _e( 'آدرس اقامتگاه :', 'jayto' ) ?><?php echo $meta['res_address'] ?></p>
	<?php
	if ( wp_is_mobile() ) {
		if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
			$latitude  = $_POST['latitude'];
			$longitude = $_POST['longitude'];

		}


		// ساختن آدرس کامل با استفاده از متغیرهای مقصد
		$fullUrl = "https://balad.ir/directions/driving?origin=" . urlencode( $longitude . "," . $latitude ) . "&destination=" . urlencode( $map_lng . "," . $map_lat ); ?>
        ?>
        <a class="direction_map" href='<?php echo $fullUrl; ?>'>مسیریابی</a>
	<?php }
	?>

    <span class="cancel_box_close"><i class="fa fa-close"></i></span>
</div>

<div id="show_host_map">
</div>
<?php
$lat = $map_lat;
$lng = $map_lng;

?>
<script>

    var map = L.map('show_host_map').setView([<?php  echo $lat?>, <?php  echo $lng?>], 15);
    L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {

        attribution: '',
    }).addTo(map);
    var marker;
    marker = new L.marker([<?php  echo $lat?>, <?php  echo $lng?>], {draggable: 'true'}).addTo(map);
    marker.on('dragend', function (e) {
        var latlng = marker.getLatLng();
        jQuery('.map_point_lat').val(latlng.lat)
        jQuery('.map_point_lng').val(latlng.lng)
    });

</script>
<style>
    #show_host_map {
        position: relative;
        width: 100%;
        height: 300px;
        left: 0;
        right: 0;
        margin: 0 auto;
        display: block;
        outline: none;
    }

    .user_cansel_trip_box {
        flex-direction: column;
    }

    .crb_head {
        margin: 10px;
        font-size: 12px;
    }
</style>
<?php
wp_die();
