<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_map extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_map';
	}

	public function get_title() {
		return 'نقشه';
	}

	public function get_script_depends() {
		return [ 'jayto_script' ];
	}

	public function get_icon() {
		return 'dashicons dashicons-embed-generic';
	}

	public function get_categories() {
		return [ 'jayto' ];
	}


	protected function register_controls() {

		$this->style_tab();
	}

	private function style_tab() {

	}

	protected function render() {

		?>
        <div id="add_site_map">
        <style>
            #add_site_map {
                height: 300px;
                border-radius: 12px;
                margin: 20px 0;
                width: 96%;
            }
        </style>

        <script>
			<?php
			$lat = get_option( 'site_map_lat' );
			$lng = get_option( 'site_map_lng' );


			if ( ! $lat ) {
				$lat = 35.7009;
			}

			if ( ! $lng ) {
				$lng = 51.3912;
			}

            $drag = 'true';
            if (!is_admin()){
                $drag = 'false';
            }

			?>

            var greenIcon = L.icon({
                iconUrl: 'marker-icon.png',
                shadowUrl: 'leaf-shadow.png',
                iconSize: [38, 95], // size of the icon
                shadowSize: [50, 64], // size of the shadow
                iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                shadowAnchor: [4, 62],  // the same for the shadow
                popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor


            });

            let map = L.map('add_site_map').setView([<?php  echo $lat?>, <?php  echo $lng?>], 15);
            L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {

                attribution: '',
            }).addTo(map);
            let marker;
            marker = new L.marker([<?php  echo $lat?>, <?php  echo $lng?>], {draggable: <?php  echo $drag?>}).addTo(map);
            <?php
                if ($_GET['action']=='elementor'){ ?>
            marker.on('dragend', function (e) {

                var latlng = marker.getLatLng();
                jQuery('.map_point_lat').val(latlng.lat)
                jQuery('.map_point_lng').val(latlng.lng)
                jQuery.ajax({
                    url: ajax_data.aju,
                    type: "POST",
                    minlength: 3,
                    data: {action: "add_site_map", lat: latlng.lat, lng: latlng.lng},
                    beforeSend: function () {

                    },
                    success: function (f) {


                    }
                })
            });
             <?php   }
            ?>
        </script>
        <input type="hidden" name="map_point_lat" class="map_point_lat">
        <input type="hidden" name="map_point_lng" class="map_point_lng">
		<?php

	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_map() );

