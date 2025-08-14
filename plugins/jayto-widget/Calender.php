<?php

class Calendar {

	private $active_year, $active_month, $active_day;
	private $events = [];
	private $validats;
	private $vbg_color;
	private $v_color;
	private $inp_date = '';
	private $check_in_date = '';
    private $reserved_dates = [];
    private $host_blocked_dates = [];
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

    public function set_check_in($check_in_date) {
		$this->check_in_date = $check_in_date;
	}

	public function set_reserved_dates($reserved_dates) {
		$this->reserved_dates = $reserved_dates;
	}

    public function set_host_blocked_dates($dates) {
        $this->host_blocked_dates = is_array($dates) ? $dates : [];
    }

    public function set_id($poid) {
        $this->post_id = $poid;
    }

	private function is_date_available($date) {
		// Check if date is in reserved dates
		if (in_array($date, $this->reserved_dates)) {
			return false;
		}
		
		// Check if date is in events (available dates)
		$events_array = [];
		foreach ( $this->events as $row ) {
			$events_array[] = $row[1];
		}
		
		return in_array($date, $events_array);
	}

	private function get_first_unavailable_after_checkin($check_in_date) {
		if (empty($check_in_date)) {
			return null;
		}

		$current_date = $check_in_date;
		$max_days = 60; // Limit search to avoid infinite loop
		$days_checked = 0;

		while ($days_checked < $max_days) {
			$current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
			$days_checked++;

			if (!$this->is_date_available($current_date)) {
				return $current_date;
			}
		}

		return null;
	}

	public function __toString() {

		$events_array = [];

		foreach ( $this->events as $row ) {
			$events_array[] = $row[1];
		}

		$disable = '';
		$milady_day = date( 'y-m-d' );
		$order_date = date( 'y-m-d', strtotime( $this->active_day . '-' . $this->active_month . '-' . $this->active_year ) );

		if ( $order_date <= $milady_day ) {
			$disable = 'disable';
		}

		// Calculate first unavailable date after check-in for check-out selection
		$first_unavailable_after_checkin = $this->get_first_unavailable_after_checkin($this->check_in_date);

		$jalai_today         = jdate( 'd', '', '', '', 'en' );
		$prev_m              = $this->active_month - 1;
		$num_days            = jdate( 't', strtotime( $this->active_day . '-' . $this->active_month . '-' . $this->active_year ), '', '', 'en' );
		$num_days_last_month = jdate( 't', strtotime( $this->active_day . '-' . $prev_m . '-' . $this->active_year ), '', '', 'en' );
		$days                = [ 0 => 'ش', 1 => 'ی', 2 => 'د', 3 => 'س', 4 => 'چ', 5 => 'پ', 6 => 'ج' ];
		$first_day_of_week   = array_search( jdate( 'D', strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'en' ), $days );

		// Determine calendar type class based on check-in status
		$calendar_type_class = !empty($this->check_in_date) ? 'checkout-calendar' : 'checkin-calendar';
		
		$html                = '<div class="calendar improved-calendar ' . $calendar_type_class . '">';
		
		// Add clear button for checkout calendar when check-in is set
		if (!empty($this->check_in_date)) {
			$html .= '<div class="calendar-clear-btn" onclick="clearCalendarSelection()" title="پاک کردن انتخاب">';
			$html .= '<span class="clear-icon">×</span>';
			$html .= '</div>';
		}
		
        $html                .= '<div class="header">';
		$html                .= '<div class="month-year">';
        $html                .= '<div class="np_calender"><span class="cal_prev ' . $disable . ' "   data-priod=0 data-cdtj=' . $milady_day . ' data-pid=' . $this->post_id . '> &#8249; </span>';
		$html                .= '<span class="month-year-text">' . jdate( 'F Y', strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'fa' ) . '</span>';
        $html                .= '<span class="cal_next" data-priod=0 data-cdtj=' . $milady_day . ' data-pid=' . $this->post_id . ' > &#8250; </span></div>';
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
                <div class="day_num ignore prev-month"><span>
                    ' . ( $num_days_last_month - $i + 1 ) . '
                    </span>
                </div>
            ';
		}
		
		for ( $i = 1; $i <= $num_days; $i ++ ) {
			$selected = '';
			$frid     = '';
			$additional_classes = '';
			
			if ( $i == $jalai_today && strtotime( date( 'Y-m' ) ) == strtotime( $this->active_year . '-' . $this->active_month ) ) {
				$selected = 'today';
			}
			
			$ignore = '';
			if ( $i < 10 ) {
				$zer = '0' . $i;
			} else {
				$zer = $i;
			}
			
			if ( $jalai_today > $i && strtotime( $order_date ) <= strtotime( $milady_day ) ) {
				$ignore = 'ignore past-date';
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
				$frid = 'friday';
			}

			$chek_in_array = jdate( 'Y-m-' . $zer, strtotime( $this->active_year . '-' . $this->active_month . '-' . $this->active_day ), '', '', 'en' );

			// Enhanced logic for date availability based on shab.ir calendar behavior
			$is_date_available = in_array( $chek_in_array, $events_array );
			$is_date_reserved = $this->reserved_dates && in_array( $chek_in_array, $this->reserved_dates );

            // Apply base availability logic
            if ( ! $is_date_available ) {
                $ignore .= ' unavailable';
            }

            if ( $is_date_reserved ) {
                $ignore .= ' reserved';
            }

            // Differentiate host-blocked dates
            if (!empty($this->host_blocked_dates) && in_array($chek_in_array, $this->host_blocked_dates)) {
                $additional_classes .= ' host-blocked';
            }

			// Special logic for check-out calendar (when check-in is set) - shab.ir style
                if (!empty($this->check_in_date)) {
				// This is checkout calendar mode
				if (strtotime($chek_in_array) <= strtotime($this->check_in_date)) {
					// Dates before or equal to check-in are disabled
					$ignore .= ' before-checkin';
				} else {
					// Dates after check-in
					// Check if this is the first unavailable date after check-in
					$is_first_unavailable = ($first_unavailable_after_checkin && $chek_in_array === $first_unavailable_after_checkin);
					
					if ($is_first_unavailable) {
						// This is the first unavailable date - it can be selectable for single-day bookings ending here
						$additional_classes .= ' first-unavailable-checkout';
						// Remove ignore class to make it clickable, but keep the visual styling
                            // IMPORTANT: Only remove generic 'ignore', keep 'unavailable'/'reserved' for true blocked days
                            $ignore = trim(str_replace(['ignore'], '', $ignore));
						
					} elseif ($first_unavailable_after_checkin && strtotime($chek_in_array) > strtotime($first_unavailable_after_checkin)) {
						// Dates after first unavailable date are completely disabled
						$ignore .= ' after-unavailable-block';
						
					} elseif ($is_date_available && !$is_date_reserved) {
						// Available dates between check-in and first unavailable date
						$additional_classes .= ' checkout-selectable';
						// Remove ignore class to make it clickable
                            $ignore = trim(str_replace(['ignore'], '', $ignore));
						
					} else {
						// Unavailable/reserved dates between check-in and first unavailable - keep disabled
						// These dates remain with their original unavailable/reserved styling
					}
				}
			}

			// Vacation dates styling
			$style_attr = '';
			if ($this->validats && in_array($fri, $this->validats)) {
				$style_attr = 'style="background-color:' . $this->vbg_color . ';color:' . $this->v_color . '"';
			}

			$html .= '<div class="day_num ' . $ignore . ' ' . $selected . ' ' . $frid . ' ' . $additional_classes . '" data-date="' . $fri . '" data-ddate="' . $ddate . '"';

			if (!empty($style_attr)) {
				$html .= ' ' . $style_attr;
			}

			$html .= '>';

			$html .= '<span>' . $i . '</span>';

			// Add events
			foreach ($this->events as $event) {
				for ($d = 0; $d <= ($event[2] - 1); $d++) {
					if ($i < 10) {
						$zero = '0' . $i;
					} else {
						$zero = $i;
					}
					$sm = jdate('Y-m-' . $zero, strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day), '', '', 'en');
					
					if ($sm == $event[1]) {
						$html .= '<div class="event' . $event[3] . '">';
						$html .= $event[0];
						$html .= '</div>';
					}
				}
			}

			$html .= '</div>';
		}

		// Fill remaining slots with next month days
		$remaining_slots = 42 - ($first_day_of_week + $num_days);
		for ( $i = 1; $i <= $remaining_slots; $i ++ ) {
			$html .= '
                <div class="day_num ignore next-month">
                    <span>' . $i . '</span>
                </div>
            ';
		}
		
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}
}
?>