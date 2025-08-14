<?php

class Calender2 {

	private $active_year, $active_month, $active_day;
	private $events = [];
	private $validats;
	private $vbg_color;
	private $v_color;
	private $inp_date = '';
	private $chech_in = '';
	private $post_id = '';

	public function __construct( $date = null ) {
		$this->validats = get_option('vacation');
		$this->vbg_color = get_option('vbg_color');
		$this->v_color = get_option('v_color');
		if ( $date != null ) {
			$exp_date = explode( '-', $date );
			list( $m_year, $m_month, $m_day ) = $exp_date;
			$shamsi_date    = gregorian_to_jalali( $m_year, $m_month, $m_day );
			$date           = jalali_to_gregorian( $shamsi_date[0], $shamsi_date[1], '1', '-' );
			$this->inp_date = $date;
		} else {
			$date     = date( 'Y-m-d' );
			$exp_date = explode( '-', $date );
			list( $m_year, $m_month, $m_day ) = $exp_date;
			$shamsi_date    = gregorian_to_jalali( $m_year, $m_month, $m_day );
			$date           = jalali_to_gregorian( $shamsi_date[0], $shamsi_date[1], '1', '-' );
			$this->inp_date = $date;
		}

		$this->active_year  = date( 'Y', strtotime( $date ) );
		$this->active_month = date( 'm', strtotime( $date ) );
		$this->active_day   = date( 'd', strtotime( $date ) );
	}

	public function add_event( $txt, $date, $days = 1, $color = '' ) {
		$color          = $color ? ' ' . $color : $color;
		$this->events[] = [ $txt, $date, $days, $color ];
	}

	public function set_id( $poid ) {

		$this->post_id = $poid ;
	}
	public function set_chech_in( $check ) {

		$this->chech_in =$check ;
	}


	public function __toString() {

		global $post;
		$events_array = [];

		foreach ( $this->events as $row ) {
			$events_array[] = $row[1];

		}



		$disable = '';

		$milady_day = date( 'y-m-d' );
		$order_date = date( 'y-m-d', strtotime( $this->active_day . '-' . $this->active_month . '-' . $this->active_year ) );
		$reserves   = get_post_meta( $this->post_id, 'resistance_reserves', true );

		$reserved = [];
		foreach($reserves as $row){
			if($row > $this->chech_in){
				$reserved[]=$row;
			}
		}

		unset($reserved[0]);
		if ( $order_date <= $milady_day ) {
			$disable = 'disable';
		}
		unset($reserved[0]);


		$jalai_today         = jdate( 'd', '', '', '', 'en' );
		$prev_m              = $this->active_month - 1;
		$num_days            = jdate( 't', strtotime( $this->active_day . '-' . $this->active_month . '-' . $this->active_year ), '', '', 'en' );
		$num_days_last_month = jdate( 't', strtotime( $this->active_day . '-' . $prev_m . '-' . $this->active_year ), '', '', 'en' );
		$days                = [ 0 => 'ش', 1 => 'ی', 2 => 'د', 3 => 'س', 4 => 'چ', 5 => 'پ', 6 => 'ج' ];
		$first_day_of_week   = array_search( jdate( 'D', strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'en' ), $days );

		$html                = '<div class="calendar">';
		$html                .= '<div class="header">';
		$html                .= '<div class="month-year">';
		$html                .= '<div class="np_calender"><span class="ccal_prev ' . $disable . ' "   data-priod=0 data-cdtj=' . $milady_day . ' data-pid=' . $this->post_id . '> < </span>';
		$html                .= jdate( 'F Y', strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'fa' );
		$html                .= '<span class="ccal_next" data-priod=0 data-cdtj=' . $milady_day . ' data-pid=' . $this->post_id . ' > > </span></div>';
		$html                .= '</div>';
		$html                .= '</div>';
		$html                .= '<div class="days">';

		foreach ( $days as $day ) {
			$html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
		}

		for ( $i = $first_day_of_week; $i > 0; $i -- ) {
			$html .= '
                <div class="day_num ignore"><Span>
                    ' . ( $num_days_last_month - $i + 1 ) . '
                    </Span>
                    
                </div>
            ';
		}
		for ( $i = 1; $i <= $num_days; $i ++ ) {
			$selected = '';
			$frid     = '';
			if ( $i == $jalai_today && strtotime( date( 'Y-m' ) ) == strtotime( $this->active_year . '-' . $this->active_month ) ) {
				$selected = 'selected';
			}
			$ignore = '';
			$bz     = '';
			if ( $i < 10 ) {
				$zer = '0' . $i;
			} else {
				$zer = $i;
			}
			if ( $jalai_today > $i && strtotime( $order_date ) <= strtotime( $milady_day ) ) {
				$ignore = 'ignore';

			}


		$ddate = jdate( $i . ' ' . 'F ', strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'en' );

			$fri                   = jdate( 'Y-m-' . $zer, strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'en' );
			$givenDate             = $this->inp_date;
			$timestampForGivenDate = strtotime( $givenDate );
			$new_i                 = $i - 1;
			$englishText7          = '+' . $new_i . ' ' . 'day';
			$requireDateFormat     = "Y-m-d";
			$jo_date               = date( $requireDateFormat, strtotime( $englishText7, $timestampForGivenDate ) );


			$f = jdate( 'D', strtotime( $jo_date ) );

			if ( $f == 'ج' ) {
				$frid = 'frid';
			}
			$nop_ig = '';

			$chek_in_array = jdate( 'Y-m-' . $zer, strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'en' );

			if ( ! in_array( $chek_in_array, $events_array ) ) {
				$nop_ig = 'ignore';
			}

			if ( $reserved ) {
				if ( in_array( $chek_in_array, $reserved ) ) {
					$ignore = 'ignore';

				}
			}
			if ($this->validats) {

				if (in_array($fri, $this->validats)) {
					$aa = 'style="background-color:' . $this->vbg_color . ';color:' . $this->v_color . '"';

				} else {
					$aa = '';
				}

			}
			if ( $fri <= $this->chech_in) {
				$ignore = 'ignore';

			}
			$html .= '<div class="day_num ' . $nop_ig . ' ' . $selected . ' ' . $ignore . ' ' . $frid . '" data-date="' . $fri . '" data-ddate="' . $ddate . '"';

			if (!empty($aa)) {
				$html .= ' ' . $aa;
			}

			$html .= '>'; // این خیلی مهمه! اینجا تگ div رو ببند.

			if (!empty($aa)) {
				$html .= '<span ' . $aa . '>' . $i . '</span>';
			} else {
				$html .= '<span>' . $i . '</span>';
			}

			foreach ($this->events as $event) {

				for ($d = 0; $d <= ($event[2] - 1); $d++) {
					if ($i < 10) {
						$zero = '0' . $i;
					} else {
						$zero = $i;
					}
				$sm = jdate('Y-m-' . $zero, strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day), '', '', 'en');
				
					if ($sm == $event[1]) {
						$html .= '<div class="event' . $event[3] . '"' . $aa . '>';
						$html .= $event[0];
						$html .= '</div>';
					}
				}
			}

			$html .= '</div>';
		}

		for ( $i = 1; $i <= ( 0 - max( $first_day_of_week, 0 ) ); $i ++ ) {
			$html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
		}
		$html .= '</div>';
		$html .= '</div>';

		return $html;


	}

}

?>