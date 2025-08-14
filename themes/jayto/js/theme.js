(function () {
    const siteNavigation = document.getElementById('site-navigation');

    // Return early if the navigation doesn't exist.
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.getElementsByTagName('button')[0];

    // Return early if the button doesn't exist.
    if ('undefined' === typeof button) {
        return;
    }

    const menu = siteNavigation.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (!menu.classList.contains('nav-menu')) {
        menu.classList.add('nav-menu');
    }

    // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
    button.addEventListener('click', function () {
        siteNavigation.classList.toggle('toggled');

        if (button.getAttribute('aria-expanded') === 'true') {
            button.setAttribute('aria-expanded', 'false');
        } else {
            button.setAttribute('aria-expanded', 'true');
        }
    });

    // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
    document.addEventListener('click', function (event) {
        const isClickInside = siteNavigation.contains(event.target);

        if (!isClickInside) {
            siteNavigation.classList.remove('toggled');
            button.setAttribute('aria-expanded', 'false');
        }
    });

    // Get all the link elements within the menu.
    const links = menu.getElementsByTagName('a');

    // Get all the link elements with children within the menu.
    const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

    // Toggle focus each time a menu link is focused or blurred.
    for (const link of links) {
        link.addEventListener('focus', toggleFocus, true);
        link.addEventListener('blur', toggleFocus, true);
    }

    // Toggle focus each time a menu link with children receive a touch event.
    for (const link of linksWithChildren) {
        link.addEventListener('touchstart', toggleFocus, false);
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        if (event.type === 'focus' || event.type === 'blur') {
            let self = this;
            // Move up through the ancestors of the current link until we hit .nav-menu.
            while (!self.classList.contains('nav-menu')) {
                // On li elements toggle the class .focus.
                if ('li' === self.tagName.toLowerCase()) {
                    self.classList.toggle('focus');
                }
                self = self.parentNode;
            }
        }

        if (event.type === 'touchstart') {
            const menuItem = this.parentNode;
            event.preventDefault();
            for (const link of menuItem.parentNode.children) {
                if (menuItem !== link) {
                    link.classList.remove('focus');
                }
            }
            menuItem.classList.toggle('focus');
        }
    }
}());


function delay(callback, ms) {
    var timer = 0;
    return function () {
        var context = this, args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            callback.apply(context, args);
        }, ms || 0);
    };
}

jQuery(document).on("keyup", ".search_city_input", delay(function () {
    var $this = jQuery(this);
    let e = $this.val();

    if (e !== undefined && e.length >= 2) {
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", minlength: 2, data: { action: "get_ajax_city_search", city: e }, beforeSend: function () {

            }, success: function (f) {

                jQuery('.search_city_input').attr('placeholder', 'انتخاب کنید..');

                jQuery('.search_result').slideDown()
                jQuery('.search_result').html(f)

            }
        })
    }

}, 500))

jQuery(document).on('click', '.related_city ul li', function () {
    let $this = jQuery(this);
    let city_select = $this.data('city');
    let city_slug = $this.data('slug');
    jQuery('.search_city_input').val(city_select)
    jQuery('.city_slug_check').val(city_slug)
})
jQuery(document).on('click', '.sb_most_ciyt_box .scmc_item', function () {
    let $this = jQuery(this);
    let city_select = $this.data('city');
    let city_slug = $this.data('slug');
    jQuery('.search_city_input').val(city_select)
    jQuery('.city_slug_check').val(city_slug)
})
jQuery(document).on('click', '.codinp ', function () {
    let $this = jQuery(this);
    let title = $this.text()
    let city_select = $this.data('city');
    let poid = $this.data('post');
    jQuery('#search_city_input').addClass('coding');
    jQuery('.search_city_input').val(title)
    jQuery('.city_slug_check').val(poid)
})
jQuery(document).on('click', '.on_plus', function () {
    let $this = jQuery(this);
    let order = $this.parents('.on_num_box').find('.on_show');
    let passenger_num = jQuery('.passenger_num').data('scap');
    let total_capacity = jQuery('.passenger_num').data('tc');
    let add_person_price = jQuery('.passenger_num').data('ep');
    let checkin = jQuery('.dpi_inp').attr('data-complete');
    checkout = jQuery('.dpo_inp').attr('data-complete');
    res_id = jQuery('#dpout').attr('data-resid')
    let order_text = order.text();
    let new_order = parseInt(order_text) + 1;
    if (new_order <= total_capacity) {
        order.text(new_order)
        jQuery('.search_num_people_input').val(new_order);
        if (new_order > passenger_num) {
            let pass_num_aaditional = new_order - passenger_num;
            let add_person_sub_price = add_person_price * pass_num_aaditional;

            jQuery('.extra_guest').remove();
            jQuery('.pselect_title').append('<span class="extra_guest"> ' + pass_num_aaditional + ' نفر مهمان اضافه</span>')

        }
        let base_url = ajax_data.turl;


        jQuery('.reserve_submit_box a').attr("href", '' + base_url + '/request?res_id=' + res_id + '&check_in=' + checkin + '&checkout=' + checkout + '&pass_num=' + new_order);
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calc_reserve_price", 'checkin': checkin, 'checkout': checkout, 'res_id': res_id, 'no_people': new_order }, beforeSend: function () {


            },

            success: function (data) {
                let result = jQuery.parseJSON(data)
                let each_night = result.count_value;
                jQuery('.res_factor_ap').remove()
                jQuery('.rft_box').remove()
                jQuery('.res_factor_item').remove()


                jQuery.each(each_night, function (index, value) {
                    let sum_each = value * index;
                    jQuery('.each_night').append("<div class='res_factor_item'><div><span>" + value + "</span><span  class='space_2x'>شب</span><span>" + index + "</span><span class='space_5x'>x</span></div><div><span>" + value * index + "</span><span class='space_2x'>تومان</span></div></div>")
                })
                if (result.sub_add_people_price > 0) {
                    jQuery('.res_factor_add_people').append('<div class="res_factor_ap"></div>')

                    jQuery('.res_factor_ap').append('<span> ' + result.add_people_num + ' نفر مهمان اضافه</span> </span> <span>' + result.sub_add_people_price + ' تومان</span>')

                }
                if (result.discount !== 0) {

                    jQuery('.each_night').append("<div class='res_factor_item'><div><span>تخفیف</span></div><div><span>" + parseFloat(result.discount).toLocaleString('en') + "</span><span class='space_2x'>تومان</span></div></div>")
                }

                // jQuery('.res_factor').append(' <span className="line90"></span>')
                jQuery('.res_factor_total').append('<div class="rft_box"></div>')
                if (result.discount !== 0) {
                    let off_pric = result.total_price - result.discount;
                    jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + parseFloat(off_pric).toLocaleString('en') + ' تومان<span/>');

                } else {
                    jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + parseFloat(result.total_price).toLocaleString('en') + ' تومان<span/>');

                }
                // jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + result.total_price + ' تومان<span/>');


            }


        })
    }

})
jQuery(document).on('click', '.hon_plus', function () {
    let $this = jQuery(this);
    let order = $this.parents('.on_num_box').find('.on_show');
    let order_text = order.text();
    let new_order = parseInt(order_text) + 1;
    order.text(new_order)
    jQuery('.search_num_people_input').val(new_order);


})
jQuery(document).on('click', '.on_minus', function () {
    let $this = jQuery(this);
    let order = $this.parents('.on_num_box').find('.on_show');
    let passenger_num = jQuery('.passenger_num').data('scap');
    let total_capacity = jQuery('.passenger_num').data('tc');
    let add_person_price = jQuery('.passenger_num').data('ep');
    let checkin = jQuery('.dpi_inp').attr('data-complete');
    checkout = jQuery('.dpo_inp').attr('data-complete');
    res_id = jQuery('#dpout').attr('data-resid')
    let order_text = order.text();
    var new_order = parseInt(order_text);

    if (parseInt(order_text) > 1) {
        jQuery('.extra_guest').remove();
        new_order = parseInt(order_text) - 1;
        if (new_order <= total_capacity) {
            order.text(new_order)
            jQuery('.search_num_people_input').val(new_order);

            let base_url = ajax_data.turl;
            jQuery('.reserve_submit_box a').attr("href", '' + base_url + '/request?res_id=' + res_id + '&check_in=' + checkin + '&checkout=' + checkout + '&pass_num=' + new_order);
            jQuery.ajax({
                url: ajax_data.aju, type: "POST", data: { action: "calc_reserve_price", 'checkin': checkin, 'checkout': checkout, 'res_id': res_id, 'no_people': new_order }, beforeSend: function () {


                },

                success: function (data) {
                    let result = jQuery.parseJSON(data)
                    let each_night = result.count_value;
                    jQuery('.res_factor_ap').remove()
                    jQuery('.rft_box').remove()
                    jQuery('.res_factor_item').remove()
                    if (result.sub_add_people_price > 0) {


                        jQuery('.res_factor_add_people').append('<div class="res_factor_ap"></div>')

                        jQuery('.res_factor_ap').append('<span> ' + result.add_people_num + ' نفر مهمان اضافه</span> </span> <span>' + result.sub_add_people_price + ' تومان</span>')

                    }
                    jQuery.each(each_night, function (index, value) {
                        let sum_each = value * index;
                        jQuery('.each_night').append("<div class='res_factor_item'><div><span>" + value + "</span><span  class='space_2x'>شب</span><span>" + index + "</span><span class='space_5x'>x</span></div><div><span>" + value * index + "</span><span class='space_2x'>تومان</span></div></div>")
                    })
                    if (new_order > passenger_num) {
                        let pass_num_aaditional = new_order - passenger_num;
                        let add_person_sub_price = add_person_price * pass_num_aaditional;


                        jQuery('.pselect_title').append('<span class="extra_guest"> ' + pass_num_aaditional + ' نفر مهمان اضافه</span>')

                    }
                    if (result.discount !== 0) {

                        jQuery('.each_night').append("<div class='res_factor_item'><div><span>تخفیف</span></div><div><span>" + parseFloat(result.discount).toLocaleString('en') + "</span><span class='space_2x'>تومان</span></div></div>")
                    }
                    // jQuery('.res_factor').append(' <span className="line90"></span>')
                    jQuery('.res_factor_total').append('<div class="rft_box"></div>')
                    if (result.discount !== 0) {
                        let off_pric = result.total_price - result.discount;
                        jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + parseFloat(off_pric).toLocaleString('en') + ' تومان<span/>');

                    } else {
                        jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + parseFloat(result.total_price).toLocaleString('en') + ' تومان<span/>');

                    }
                    // jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + result.total_price + ' تومان<span/>');

                }


            })
        }
    }


})
jQuery(document).on('click', '.hon_minus', function () {
    let $this = jQuery(this);
    let order = $this.parents('.on_num_box').find('.on_show');

    let order_text = order.text();
    let new_order = parseInt(order_text) - 1;
    if (new_order >= 0) {
        order.text(new_order)
        jQuery('.search_num_people_input').val(new_order);

    }

})
jQuery(document).on('focus', '.sbi', function () {
    let $this = jQuery(this);
    let s_box = jQuery('.sbox');
    s_box.fadeOut(0);
    let parent = $this.parents('.sedi')
    let this_sbox = parent.find('.sbox');
    this_sbox.slideDown();
    jQuery('#in_picker').hide()
    jQuery('#out_picker').hide()

})
jQuery(document).on('focus', '.dpi_inp', function () {

    let $this = jQuery(this);
    let parents = $this.parents('#dpin');

    parents.find('.in_calender').css({ 'display': 'flex' });
    jQuery('#dpin').addClass('active')
    jQuery('#dpout').removeClass('active')

})
jQuery(document).on('focus', '#dpi', function () {
    jQuery('#out_picker').hide(0)

})
jQuery(document).on('focus', '#dpo', function () {
    jQuery('#in_picker').hide(0)

})
// jQuery(document).on('focus', '.dpo_inp', function () {
//
//     jQuery('#dpin').addClass('active');
//     jQuery('#dpout').removeClass('active');
// })
jQuery(document).on('click', ' .in_calender .days .day_num ', function () {

    let $this = jQuery(this);
    let parent = $this.parent('#dpin');
    let res_id = jQuery('#dpin').attr('data-resid')
    let elm = $this.data('date');
    let elm_c = jQuery('.dpo_inp').attr('data-complete');
    let elm_d = $this.data('ddate');
    let dp_in = jQuery('.dpi_inp');
    let no_people = jQuery('.on_show').text();
    let out_val = dp_in.val();
    let base_url = ajax_data.turl;
    let out_cal = jQuery('.out_calender ');

    // Enhanced date selection validation
    if ($this.hasClass('ignore') || $this.hasClass('unavailable') || $this.hasClass('reserved') || $this.hasClass('past-date')) {
        return false;
    }

    // Add animation effect
    $this.addClass('animate-select');
    setTimeout(function() {
        $this.removeClass('animate-select');
    }, 300);

    // Clear previous selection styling
    jQuery('.in_calender .days .day_num').removeClass('selected');
    $this.addClass('selected');

    jQuery.ajax({
        url: ajax_data.aju,
        type: 'POST',
        data: {
            action: 'set_selected_date',
            date: elm,
            ddate: elm_d
        },
        success: function (response) {
            console.log(response.data.message);
        }
    });

    // Enhanced checkout calendar logic - only enable dates until first unavailable date
    updateCheckoutCalendar(elm, out_cal);

    // Set check-in date
    let checkin = $this.data('date');
    dp_in.val(elm_d);
    dp_in.attr('data-complete', elm);
    
    // Clear checkout date if it's before check-in or invalid
    let checkout_date = jQuery('.dpo_inp').attr('data-complete');
    if (checkout_date && new Date(checkout_date) <= new Date(elm)) {
        jQuery('.dpo_inp').val('');
        jQuery('.dpo_inp').attr('data-complete', '');
        jQuery('.res_factor_ap').remove();
        jQuery('.rft_box').remove();
        jQuery('.res_factor_item').remove();
        jQuery('.reserve_submit_box a').css({ 'background': 'gray', 'pointer-events': 'none' });
    }

    jQuery('.in_calender').hide(0);
    jQuery('#dpin').removeClass('active');
    jQuery('#dpout').addClass('active');
    jQuery('.out_calender').css({ 'display': 'flex' });

    // Calculate price if checkout is already selected and valid
    if (checkout_date && new Date(checkout_date) > new Date(elm)) {
        calculatePrice(elm, checkout_date, res_id, no_people, elm_d);
    }
});

// Function to update checkout calendar based on check-in selection - shab.ir style
function updateCheckoutCalendar(checkinDate, outCalendar) {
    // Reset all classes first
    outCalendar.find('.day_num').removeClass('before-checkin after-unavailable-block checkout-selectable first-unavailable-checkout');
    
    // Find the first unavailable date after check-in
    let firstUnavailableDate = null;
    let currentDate = new Date(checkinDate);
    let maxDays = 60; // Limit search
    let daysChecked = 0;
    
    // Create a copy to avoid modifying the original date
    let searchDate = new Date(currentDate);
    
    while (daysChecked < maxDays && !firstUnavailableDate) {
        searchDate.setDate(searchDate.getDate() + 1);
        daysChecked++;
        
        let checkDateStr = searchDate.getFullYear() + '-' + 
            String(searchDate.getMonth() + 1).padStart(2, '0') + '-' + 
            String(searchDate.getDate()).padStart(2, '0');
        
        let dayElement = outCalendar.find("[data-date='" + checkDateStr + "']");
        
        // Check if this date is originally unavailable or reserved (before we modified classes)
        if (dayElement.length > 0) {
            let isOriginallyUnavailable = dayElement.hasClass('unavailable') || 
                                        dayElement.hasClass('reserved') || 
                                        dayElement.hasClass('past-date');
            
            if (isOriginallyUnavailable) {
                firstUnavailableDate = checkDateStr;
                break;
            }
        }
    }
    
    // Apply shab.ir logic to each date
    outCalendar.find('.day_num').each(function() {
        let dayDate = jQuery(this).data('date');
        let dayElement = jQuery(this);
        let dayTimestamp = new Date(dayDate).getTime();
        let checkinTimestamp = new Date(checkinDate).getTime();
        
        // Store original state
        let wasOriginallyUnavailable = dayElement.hasClass('unavailable');
        let wasOriginallyReserved = dayElement.hasClass('reserved');
        let wasOriginallyPast = dayElement.hasClass('past-date');
        
        if (dayTimestamp <= checkinTimestamp) {
            // Dates before or equal to check-in are disabled
            dayElement.addClass('before-checkin ignore');
            
        } else {
            // Dates after check-in
            if (firstUnavailableDate) {
                let firstUnavailableTimestamp = new Date(firstUnavailableDate).getTime();
                
                if (dayTimestamp > firstUnavailableTimestamp) {
                    // Dates after first unavailable date are completely disabled
                    dayElement.addClass('after-unavailable-block ignore');
                    
                } else if (dayDate === firstUnavailableDate) {
                    // This is the first unavailable date - special case for shab.ir logic
                    // It can be selected for single-night bookings ending on an unavailable day
                    dayElement.addClass('first-unavailable-checkout').removeClass('ignore');
                    
                    // Don't remove the original unavailable/reserved classes for visual indication
                    // but make it clickable
                    
                } else {
                    // Dates between check-in and first unavailable date
                    if (!wasOriginallyUnavailable && !wasOriginallyReserved && !wasOriginallyPast) {
                        // Available dates - make them selectable
                        dayElement.addClass('checkout-selectable').removeClass('ignore');
                    } else {
                        // Originally unavailable dates in between - keep them disabled
                        dayElement.addClass('ignore');
                    }
                }
            } else {
                // No unavailable dates found ahead - check individual date availability
                if (!wasOriginallyUnavailable && !wasOriginallyReserved && !wasOriginallyPast) {
                    dayElement.addClass('checkout-selectable').removeClass('ignore');
                } else {
                    dayElement.addClass('ignore');
                }
            }
        }
    });
    
    // Log for debugging
    console.log('Check-in date:', checkinDate);
    console.log('First unavailable date after check-in:', firstUnavailableDate);
}

// Clear calendar selection function
function clearCalendarSelection() {
    // Clear check-in date
    jQuery('.dpi_inp').val('').attr('data-complete', '');
    
    // Clear check-out date  
    jQuery('.dpo_inp').val('').attr('data-complete', '');
    
    // Remove any selected styling and checkout-specific classes
    jQuery('.calendar .day_num').removeClass('selected before-checkin after-unavailable-block checkout-selectable first-unavailable-checkout');
    
    // Hide calendars
    jQuery('.in_calender').hide();
    jQuery('.out_calender').hide();
    
    // Reset calendar states
    jQuery('#dpin').removeClass('active');
    jQuery('#dpout').removeClass('active');
    
    // Remove pricing information
    jQuery('.res_factor_ap').remove();
    jQuery('.rft_box').remove();
    jQuery('.res_factor_item').remove();
    jQuery('.alertno').fadeOut();
    
    // Reset booking button
    jQuery('.reserve_submit_box a').css({
        'background': '#gray',
        'pointer-events': 'none'
    }).attr('href', '#');
    
    // Remove any error/success messages
    jQuery('.date-selection-error').remove();
    jQuery('.date-clear-message').remove();
    
    // Show success message
    showDateClearMessage('انتخاب تاریخ‌ها پاک شد');
    
    // Reset calendar to original state by reloading if needed
    setTimeout(function() {
        // Trigger calendar refresh if there's a method for it
        if (typeof refreshCalendars === 'function') {
            refreshCalendars();
        }
    }, 500);
}

// Function to show clear message
function showDateClearMessage(message) {
    // Remove any existing messages
    jQuery('.date-clear-message').remove();
    
    // Create and show message
    let messageDiv = '<div class="date-clear-message" style="background: #e8f5e8; color: #2e7d32; padding: 10px; border-radius: 5px; margin: 10px 0; border: 1px solid #c8e6c9; text-align: center;">' + message + '</div>';
    
    if (jQuery('.calendar').length > 0) {
        jQuery('.calendar').first().after(messageDiv);
    } else {
        jQuery('body').append(messageDiv);
    }
    
    // Auto-hide after 3 seconds
    setTimeout(function() {
        jQuery('.date-clear-message').fadeOut();
    }, 3000);
}
jQuery(document).on('click', ' .out_calender .days .day_num ', function () {
    let $this = jQuery(this);
    let parent = $this.parent('#dpout');
    let res_id = jQuery('#dpout').attr('data-resid')
    let elm = $this.data('date');
    let elm_d = $this.data('ddate');
    let elm_c = jQuery('.dpi_inp').attr('data-complete');
    let dp_out = jQuery('.dpo_inp');
    let no_people = Number(jQuery('.on_show').text())
    let out_cal = jQuery('.out_calender ');

    // Enhanced validation for checkout date selection - shab.ir style
    if (!elm_c) {
        showDateSelectionError('لطفا ابتدا تاریخ ورود را انتخاب کنید');
        return false;
    }
    
    // Check if the date is selectable based on shab.ir logic
    let isSelectableForCheckout = $this.hasClass('checkout-selectable') || $this.hasClass('first-unavailable-checkout');
    
    if ($this.hasClass('ignore') && !$this.hasClass('first-unavailable-checkout')) {
        // Show specific error messages
        if ($this.hasClass('before-checkin')) {
            showDateSelectionError('تاریخ خروج نمی‌تواند قبل از تاریخ ورود باشد');
        } else if ($this.hasClass('after-unavailable-block')) {
            showDateSelectionError('بعد از روزهای غیرفعال امکان انتخاب وجود ندارد');
        } else if ($this.hasClass('past-date')) {
            showDateSelectionError('نمی‌توانید تاریخ گذشته را انتخاب کنید');
        } else {
            showDateSelectionError('این تاریخ قابل انتخاب نیست');
        }
        return false;
    }
    
    if (!isSelectableForCheckout) {
        if ($this.hasClass('unavailable')) {
            showDateSelectionError('این تاریخ غیرفعال است');
        } else if ($this.hasClass('reserved')) {
            showDateSelectionError('این تاریخ رزرو شده است');
        } else {
            showDateSelectionError('تاریخ انتخابی قابل انتخاب نیست');
        }
        return false;
    }

    // Validate that checkout date is after check-in
    if (new Date(elm) <= new Date(elm_c)) {
        showDateSelectionError('تاریخ خروج باید بعد از تاریخ ورود باشد');
        return false;
    }

    // Add animation effect
    $this.addClass('animate-select');
    setTimeout(function() {
        $this.removeClass('animate-select');
    }, 300);

    // Clear previous selection styling
    jQuery('.out_calender .days .day_num').removeClass('selected');
    $this.addClass('selected');

    jQuery.ajax({
        url: ajax_data.aju,
        type: 'POST',
        data: {
            action: 'set_selected_date_out',
            date: elm,
            ddate: elm_d
        },
        success: function (response) {
            // console.log(response.data.message);
        }
    });

    // Set checkout date
    dp_out.val(elm_d);
    dp_out.attr('data-complete', elm);
    let checkout = elm;
    
    jQuery('.out_calender').hide(0);
    jQuery('#dpin').removeClass('active');
    jQuery('#dpout').removeClass('active');

    // Calculate price for the selected date range
    calculatePrice(elm_c, checkout, res_id, no_people, elm_d);
});

// Admin/host calendar bulk tools (in host edit template)
jQuery(document).on('click', '#host_date_manager .calendar .day_num', function () {
    const $day = jQuery(this);
    // اجازه انتخاب روی همه روزها، حتی رزروشده/غیرفعال، چون هدف مدیریت آنهاست
    $day.toggleClass('adm-selected');
});

function getSelectedDatesFromHostManager() {
    const dates = [];
    jQuery('#host_date_manager .calendar .day_num.adm-selected').each(function () {
        const d = jQuery(this).attr('data-date');
        if (d) dates.push(d);
    });
    return dates;
}

function postAdminReserveDates(actionName, dates, pid) {
    if (!dates.length || !pid) return;
    jQuery.ajax({
        url: ajax_data.aju,
        type: 'POST',
        data: { action: actionName, dates: dates.join(' ~ '), pid: pid },
        success: function () { refreshHostManager(pid); }
    });
}

jQuery(document).on('click', '#host_date_manager .disable-selected', function () {
    const dates = getSelectedDatesFromHostManager();
    const pid = jQuery('#host_date_manager').data('resid');
    postAdminReserveDates('set_residence_custom_reserve', dates, pid);
});

jQuery(document).on('click', '#host_date_manager .enable-selected', function () {
    const dates = getSelectedDatesFromHostManager();
    const pid = jQuery('#host_date_manager').data('resid');
    postAdminReserveDates('custom_reserve_return', dates, pid);
});

jQuery(document).on('click', '#host_date_manager .set-price-selected', function () {
    const dates = getSelectedDatesFromHostManager();
    const pid = jQuery('#host_date_manager').data('resid');
    const price = jQuery('#host_date_manager .admin-price-input').val();
    if (!dates.length || !pid || !price) return;
    jQuery.ajax({
        url: ajax_data.aju,
        type: 'POST',
        data: { action: 'set_residence_dprice', dates: dates.join(' ~ '), price: price, pid: pid },
        success: function () { refreshHostManager(pid); }
    });
});

function refreshHostManager(pid){
    if(!pid) return;
    jQuery.ajax({
        url: ajax_data.aju,
        type: 'POST',
        data: { action: 'refresh_host_date_manager', pid: pid },
        success: function(html){
            // جایگزین‌کردن فقط بخش تقویم‌ها
            const $box = jQuery('#host_date_manager');
            if($box.length){
                const $tmp = jQuery('<div/>').html(html);
                $box.find('.calender_box1').html($tmp.find('.calender_box1').html());
                $box.find('.calender_box2').html($tmp.find('.calender_box2').html());
                // پاک‌کردن انتخاب‌های قبلی
                $box.find('.day_num').removeClass('adm-selected');
            }
        }
    })
}

// Function to calculate and display price
function calculatePrice(checkin, checkout, res_id, no_people, elm_d) {
    // Always clear previous breakdown before new calc to avoid duplicates
    jQuery('.res_factor_ap, .rft_box, .res_factor_item').remove();
    jQuery.ajax({
        url: ajax_data.aju, 
        type: "POST", 
        data: { 
            action: "calc_reserve_price", 
            'checkin': checkin, 
            'checkout': checkout, 
            'res_id': res_id, 
            'no_people': no_people, 
            'ddate_out': elm_d 
        }, 
        beforeSend: function () {
            // Show loading state
            jQuery('.reserve_submit_box a').css({ 'background': '#gray', 'pointer-events': 'none' });
        }, 
        success: function (data) {
            let result = jQuery.parseJSON(data);
            console.log(result);

            if (result.allow === 'yes') {
                // Clear previous calculations (already cleared before request; keep for safety)
                jQuery('.res_factor_ap, .rft_box, .res_factor_item').remove();
                jQuery('.alertno').fadeOut();
                
                // Enable submit button
                jQuery('.reserve_submit_box a').css({ 'background': '#424242', 'pointer-events': 'auto' });
                
                let each_night = result.count_value;
                
                // Add extra people cost if applicable
                if (result.sub_add_people_price > 0) {
                    jQuery('.res_factor_add_people').append('<div class="res_factor_ap"></div>');
                    jQuery('.res_factor_ap').append('<span>' + result.add_people_num + ' نفر مهمان اضافه</span> <span>' + result.sub_add_people_price.toLocaleString('fa') + ' تومان</span>');
                }
                
                // Add nightly rates
                jQuery.each(each_night, function (index, value) {
                    jQuery('.each_night').append(
                        "<div class='res_factor_item'>" +
                        "<div><span>" + index + "</span><span class='space_2x'>شب</span><span>" + value.toLocaleString('fa') + "</span><span class='space_5x'>تومان</span></div>" +
                        "<div><span>" + (value * index).toLocaleString('fa') + "</span><span class='space_2x'>تومان</span></div>" +
                        "</div>"
                    );
                });
                
                // Add discount if applicable
                if (result.discount !== 0) {
                    jQuery('.each_night').append(
                        "<div class='res_factor_item discount'>" +
                        "<div><span>تخفیف</span></div>" +
                        "<div><span>-" + parseFloat(result.discount).toLocaleString('fa') + "</span><span class='space_2x'>تومان</span></div>" +
                        "</div>"
                    );
                }

                // Add total amount
                jQuery('.res_factor_total').append('<div class="rft_box"></div>');
                let finalPrice = result.discount !== 0 ? (result.total_price - result.discount) : result.total_price;
                jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + parseFloat(finalPrice).toLocaleString('fa') + ' تومان</span>');
                
                // Update reservation link
                let checki = jQuery('.dpi_inp').attr('data-complete');
                let base_url = ajax_data.turl;
                jQuery('.reserve_submit_box a').attr("href", base_url + '/request?res_id=' + res_id + '&check_in=' + checki + '&checkout=' + checkout + '&pass_num=' + no_people);
                
            } else {
                // Handle error case
                jQuery('.res_factor_ap').remove();
                jQuery('.rft_box').remove();
                jQuery('.res_factor_item').remove();
                jQuery('.reserve_submit_box a').css({ 'background': 'gray', 'pointer-events': 'none' });
                jQuery('.alertno').fadeIn();
                showDateSelectionError('امکان رزرو در این بازه زمانی وجود ندارد');
            }
        },
        error: function() {
            showDateSelectionError('خطا در محاسبه قیمت. لطفا دوباره تلاش کنید');
        }
    });
}

// Function to show user-friendly error messages
function showDateSelectionError(message) {
    // Disabled banner: do nothing (keep logic paths intact)
}
jQuery(document).on('change', ' .in_calender  ', function () {
    let $this = jQuery(this);
    let parent = $this.parent('#dpin');
    let res_id = jQuery('#dpin').attr('data-resid')
    let elm = $this.data('date');
    let elm_c = jQuery('.dpo_inp').attr('data-complete');
    let elm_d = $this.data('ddate');
    let dp_in = jQuery('.dpi_inp');
    let no_people = jQuery('.on_show').text();
    let out_val = dp_in.val();
    let base_url = ajax_data.turl;

    if (out_val !== '') {
        if (!$this.hasClass('ignore')) {

            if (elm < elm_c) {
                let checkin = jQuery('.dpi_inp').attr('data-complete');
                let checkout = jQuery('.dpo_inp').attr('data-complete');
                let dp_in = $this.attr('data-date');
                jQuery('.dpi_inp').val(elm_d);
                jQuery('.dpi_inp').attr('data-complete', elm);
                jQuery('.in_calender').hide(0);

                jQuery.ajax({
                    url: ajax_data.aju, type: "POST", data: { action: "calc_reserve_price", 'checkin': dp_in, 'checkout': checkout, 'res_id': res_id, 'no_people': no_people }, beforeSend: function () {
                    }, success: function (data) {
                        let result = jQuery.parseJSON(data)
                        console.log(suc)
                        let each_night = result.count_value;

                        jQuery('.res_factor_ap').remove()
                        jQuery('.rft_box').remove()
                        jQuery('.res_factor_item').remove()
                        if (result.sub_add_people_price > 0) {
                            jQuery('.res_factor_add_people').append('<div class="res_factor_ap"></div>')

                            jQuery('.res_factor_ap').append('<span> ' + result.add_people_num + ' نفر مهمان اضافه</span> </span> <span>' + result.sub_add_people_price + ' تومان</span>')

                        }
                        jQuery.each(each_night, function (index, value) {
                            let sum_each = value * index;
                            jQuery('.each_night').append("<div class='res_factor_item'><div><span>" + value + "</span><span  class='space_2x'>شب</span><span>" + index + "</span><span class='space_5x'>x</span></div><div><span>" + value * index + "</span><span class='space_2x'>تومان</span></div></div>")
                        })
                        // jQuery('.res_factor').append(' <span className="line90"></span>')
                        jQuery('.res_factor_total').append('<div class="rft_box"></div>')
                        jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + result.total_price + ' تومان<span/>');
                        let checki = jQuery('.dpi_inp').attr('data-complete')
                        base_url = ajax_data.turl;
                        jQuery('.reserve_submit_box a').attr("href", '' + base_url + '/request?res_id=' + res_id + '&check_in=' + checki + '&checkout=' + checkout + '&pass_num=' + no_people);
                    }
                })
            }
        }
    } else {
        if (!$this.hasClass('ignore')) {

            let checkin = $this.data('date');
            dp_in.val(elm_d);
            dp_in.attr('data-complete', elm);
            jQuery('.in_calender').hide(0);
        }
    }


})


function decodeHtml(str) {
    var map = {
        '&amp;': '&', '&lt;': '<', '&gt;': '>', '&quot;': '"', '&#039;': "'"
    };
    return str.replace(/&amp;|&lt;|&gt;|&quot;|&#039;/g, function (m) {
        return map[m];
    });
}

jQuery(document).ready(function () {
    jQuery(document).on('click', '.cal_next', function () {

        let $this = jQuery(this);
        let month = $this.attr('data-cdtj');
        let post_id = $this.attr('data-pid');
        let calender_priod = Number($this.attr('data-priod'));
        let current_priod = jQuery('.cal_prev').attr('data-priod');
        let next_number = calender_priod + 1;
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_next_month", 'month': month, 'pid': post_id, 'priod': next_number }, beforeSend: function () {
            }, success: function (data) {

                jQuery('.in_calender').html(data);
                jQuery('.out_calender').html(data);
                // Re-apply checkout selection rules if a check-in date exists
                const next_date = jQuery('.dpi_inp').attr('data-complete');
                if (next_date) {
                    updateCheckoutCalendar(next_date, jQuery('.out_calender'));
                }
                jQuery(document).ready(function () {
                    jQuery('.cal_next').replaceWith('<span class="cal_next" data-priod="' + next_number + '" data-cdtj="' + month + '" data-pid="' + post_id + '"> &gt; </span>')
                })
            }
        })
    })
})
jQuery(document).ready(function () {
    jQuery(document).on('click', '.cal_desk_next', function () {

        let $this = jQuery(this);
        let month = $this.attr('data-cdtj');
        let post_id = $this.attr('data-pid');
        let calender_priod = Number($this.attr('data-priod'));
        let current_priod = jQuery('.cal_desk_prev').attr('data-priod');
        let next_number = calender_priod + 1;
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_desk_next_month", 'month': month, 'pid': post_id, 'priod': next_number }, beforeSend: function () {
            }, success: function (data) {


                jQuery(' .calender_box1').html(data);

            }
        })
    })
})
jQuery(document).ready(function () {
    jQuery(document).on('click', '.cal_desk_next', function () {

        let $this = jQuery(this);
        let month = $this.attr('data-cdtj');
        let post_id = $this.attr('data-pid');
        let calender_priod = Number($this.attr('data-priod'));
        let current_priod = jQuery('.cal_desk_prev').attr('data-priod');
        let next_number = calender_priod + 1;
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_desk2_next_month", 'month': month, 'pid': post_id, 'priod': next_number }, beforeSend: function () {
            }, success: function (data) {
                jQuery(' .calender_box2').html(data);
                jQuery(document).ready(function () {
                    jQuery('.cal_desk_next').replaceWith('<span class="cal_desk_next" data-priod="' + next_number + '" data-cdtj="' + month + '" data-pid="' + post_id + '"> &gt; </span>')
                })

            }
        })
    })
})
jQuery(document).ready(function () {
    jQuery(document).on('click', '.cal_desk_prev', function () {

        let $this = jQuery(this);
        let cal_next = jQuery('.cal_next');
        let month = cal_next.attr('data-cdtj');
        let post_id = $this.attr('data-pid');
        let calender_priod = Number($this.attr('data-priod'));
        let current_priod = jQuery('.cal_desk_next').attr('data-priod');
        let next_number = current_priod - 1;
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_desk_next_month", 'month': month, 'pid': post_id, 'priod': next_number }, beforeSend: function () {
            }, success: function (data) {


                jQuery(' .calender_box1').html(data);

            }
        })
    })
})
jQuery(document).ready(function () {
    jQuery(document).on('click', '.cal_desk_prev', function () {

        let $this = jQuery(this);
        let cal_next = jQuery('.cal_next');
        let month = cal_next.attr('data-cdtj');
        let post_id = $this.attr('data-pid');
        let calender_priod = Number($this.attr('data-priod'));
        let current_priod = jQuery('.cal_desk_next').attr('data-priod');
        let next_number = current_priod - 1;
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_desk2_next_month", 'month': month, 'pid': post_id, 'priod': next_number }, beforeSend: function () {
            }, success: function (data) {
                jQuery(' .calender_box2').html(data);
                jQuery(document).ready(function () {
                    jQuery('.cal_desk_next').replaceWith('<span class="cal_desk_next" data-priod="' + next_number + '" data-cdtj="' + month + '" data-pid="' + post_id + '"> &gt; </span>')
                })

            }
        })
    })
})
jQuery(document).ready(function () {
    jQuery(document).on('click', '.cal_prev', function () {
        let $this = jQuery(this);
        let cal_next = jQuery('.cal_next');
        let month = cal_next.attr('data-cdtj');
        let post_id = cal_next.attr('data-pid');
        let current_priod = cal_next.attr('data-priod');
        let next_priod = Number(current_priod) - 1;

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_prev_month", 'month': month, 'pid': post_id, 'priod': current_priod }, beforeSend: function () {
            }, success: function (data) {
                jQuery('.in_calender').html(data);
                jQuery('.out_calender').html(data);
                // Re-apply checkout selection rules if a check-in date exists
                const next_date = jQuery('.dpi_inp').attr('data-complete');
                if (next_date) {
                    updateCheckoutCalendar(next_date, jQuery('.out_calender'));
                }
                jQuery(document).ready(function () {
                    jQuery('.cal_next').replaceWith('<span class="cal_next" data-priod="' + next_priod + '" data-cdtj="' + month + '" data-pid="' + post_id + '"> &gt; </span>')


                })
            }
        })
    })

})
jQuery(document).on('click', '.all_image_but', function () {
    jQuery('.swiper-box').css({ 'visibility': 'visible', 'opacity': '1' })
})
jQuery(document).on('click', '.com_cansel', function () {
    jQuery('.cancel_reserv_box').css({ 'visibility': 'visible', 'opacity': '1' })
})
jQuery(document).on('click', '.cancel_box_close', function () {
    jQuery('.cancel_reserv_box').css({ 'visibility': 'hidden', 'opacity': '0' })
})
jQuery(document).on('click', '.cancel_box_close', function () {
    jQuery('.user_cansel_trip_box').css({ 'visibility': 'hidden', 'opacity': '0' })
})
jQuery(document).on('click', '.bc_close_icon', function () {
    jQuery('.swiper-box').css({ 'visibility': 'hidden', 'opacity': '0' })
})
jQuery(document).on('click', '.plus_but', function () {
    let $this = jQuery(this);
    let parent = $this.parents('.add_min_box');
    let elm = parent.find('.mp_val');

    let elm_val = elm.text();
    if (Number(elm_val + 1) > 0) {
        jQuery('.arch_submit_num').addClass('active')
    }
    elm.text(Number(elm_val) + 1);
    let new_text = Number(elm_val) + 1
    jQuery('.no_matt').text('' + new_text + ' ' + 'نفر')
    jQuery('.pn_input').val(Number(elm_val) + 1);
    jQuery('.shpn').text('نفر');

})
jQuery(document).on('click', '.plus_but_filter', function () {
    let $this = jQuery(this);
    let parent = $this.parents('.add_min_box');
    let elm = parent.find('.rmp_val');

    let elm_val = elm.text();
    if (Number(elm_val + 1) > 0) {
        jQuery('.arch_room_num_submit').addClass('active')
    }

    elm.text(Number(elm_val) + 1);
    let new_text = Number(elm_val) + 1;

    jQuery('.rpn_input').val(Number(elm_val) + 1);
    jQuery('.show_rn_txt').text('اتاق');
    jQuery('.no_matt_room').text('' + new_text + ' ' + 'اتاق');

})
jQuery(document).on('click', '.minus_but_filter', function () {
    let $this = jQuery(this);
    let parent = $this.parents('.add_min_box');
    let elm = parent.find('.rmp_val');
    let elm_val = elm.text();
    if (Number(elm_val) > 1) {
        elm.text(Number(elm_val) - 1);
        let new_text = Number(elm_val) - 1
        jQuery('.no_matt_room').text('' + new_text + ' ' + 'نفر');
        jQuery('.rpn_input').val(Number(elm_val) - 1);
        jQuery('.show_rn_txt').text('اتاق');
    }

})
jQuery(document).on('click', '.minus_but', function () {
    let $this = jQuery(this);
    let parent = $this.parents('.add_min_box');
    let elm = parent.find('.mp_val');
    let elm_val = elm.text();
    if (Number(elm_val) > 1) {
        elm.text(Number(elm_val) - 1);
        let new_text = Number(elm_val) - 1
        jQuery('.no_matt').text('' + new_text + ' ' + 'نفر');
        jQuery('.pn_input').val(Number(elm_val) - 1);
        jQuery('.shpn').text('نفر');
    }

})
jQuery(document).on('click', '.mor_content', function () {
    jQuery('.hotel_box_description').toggleClass('active');
    jQuery('.mor_content_ico').toggleClass('active');

})
jQuery(document).on('click', '.filter_date', function () {
    jQuery('.filbox').css({ 'visibility': 'hidden', 'opacity': '0' })
})
jQuery(document).on('click', '.subm', function () {
    let $this = jQuery(this);
    let post_people_num = jQuery('.mp_val').text()
    let post_min_price = jQuery('#min_price').val()
    let post_max_price = jQuery('#max_price').val()
    let room_search_num = jQuery('.rpn_input').val()
    let post_taxonomy = jQuery('.tax_h').data('tax')
    let term_id = jQuery('.tax_h').data('tid')

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_archive_filter", 'post_people_num': post_people_num, 'post_min_price': post_min_price, 'post_max_price': post_max_price, 'taxonomy': post_taxonomy, 'term_id': term_id, 'room_search_num': room_search_num }, beforeSend: function () {

        }, success: function (e) {

            jQuery('.archive_box').html(e)

        }

    })

})
jQuery(document).on('click', '.arch_clos_num', function () {
    let $this = jQuery(this);
    let pn_input = jQuery('.pn_input');
    let input_new_val = jQuery('.no_matt').text();
    pn_input.val('');
    jQuery('.mp_val').text(0)
    jQuery('.no_matt').text('مهم نیست')
    jQuery('.shpn').text('')
})

jQuery(document).on('click', '.arch_room_arch_clos_num', function () {
    let $this = jQuery(this);
    let rpn_input = jQuery('.rpn_input');
    let input_new_val = jQuery('.no_matt_room').text();
    rpn_input.val('');
    jQuery('.rmp_val').text('0');
    jQuery('.show_rn_txt').text('');


    jQuery('.no_matt_room').text('مهم نیست')
})

jQuery(document).on('click', '.fillimp', function () {
    let $this = jQuery(this);
    jQuery('.filbox').css({ 'opacity': '0', 'visibility': 'hidden' });
    let parent = $this.parents('.pinp')
    let box = parent.find(('.filbox'))
    box.css({ 'opacity': '1', 'visibility': 'visible' });
})
jQuery(document).on('input', '#min_price', function () {
    let $this = jQuery(this);
    let select_val = $this.val();
    jQuery('.range_input_min').html(select_val);
    // jQuery('.arch_submit_price').addClass('active');
})
jQuery(document).on('input', '#max_price', function () {
    let $this = jQuery(this);
    let select_val = $this.val();
    jQuery('.range_input_max').html(select_val);
    // jQuery('.arch_submit_price').addClass('active');
})
jQuery(document).on('click', '.arch_clos_price', function () {
    let pr_max = jQuery('#max_price')
    let pr_min = jQuery('#min_price')
    pr_max.val('5000000');
    pr_min.val('5000');
    jQuery('.price_input').val('')
})

jQuery(document).on('click', '.n_plus', function () {
    let $this = jQuery(this);
    let order = $this.parents('.on_num_box').find('.n_show');
    let order_text = order.text();
    let new_order = parseInt(order_text) + 1;
    order.text(new_order)
    jQuery('.search_num_people_input').val(new_order)
})
jQuery(document).on('click', '#search_but', function () {
    let $this = jQuery(this);
    let post_city = jQuery('.city_slug_check').val()
    let post_input_date = jQuery('#search_date_in_input').val()
    let post_out_date = jQuery('#search_date_out_input').val()
    let post_people_number = jQuery('.search_num_people_input').val();
    if (post_city.length === 0) {
        jQuery('.srarch_city').css({ 'border': '1px solid #FF5722', 'border-radius': '7px' })
    } else {
        if (jQuery('#search_city_input').hasClass('coding')) {
            jQuery.ajax({
                url: ajax_data.aju, type: "POST", data: { action: "get_post_search_link", 'pid': post_city }, beforeSend: function () {

                }, success: function (e) {
                    window.location.href = e + "/?in_date=" + post_input_date + "&out_date=" + post_out_date + "&cap=" + post_people_number;

                }

            })
        } else {
            jQuery.ajax({
                url: ajax_data.aju, type: "POST", data: { action: "get_archive_filter" }, beforeSend: function () {

                }, success: function (e) {
                    window.location.href = ajax_data.siteurl + "/city/" + post_city + "/?in_date=" + post_input_date + "&out_date=" + post_out_date + "&cap=" + post_people_number;

                }

            })
        }

    }


})
jQuery(document).on('click', '#search_but_st', function () {
    let $this = jQuery(this);

    let post_input_date = jQuery('#search_date_in_input2').val()
    let post_out_date = jQuery('#search_date_out_input2').val()
    let post_people_number = jQuery('.search_num_people_input').val();

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_single_hotel_search_link" }, beforeSend: function () {

        }, success: function (e) {

            window.location.replace(e + "/?in_date=" + post_input_date + "&out_date=" + post_out_date + "&cap=" + post_people_number + "&ssp");

        }

    })


})
jQuery(document).on('click', '.n_minus', function () {
    let $this = jQuery(this);
    let order = $this.parents('.on_num_box').find('.n_show');
    let order_text = order.text();
    let new_order = parseInt(order_text) - 1;
    if (order_text > 1) {
        jQuery('.n_show').text(new_order)
        jQuery('.search_num_people_input').val(new_order)
    }
})

function separate(Number) {
    Number += '';
    Number = Number.replace(',', '');
    x = Number.split('.');
    y = x[0];
    z = x.length > 1 ? '.' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(y)) y = y.replace(rgx, '$1' + ',' + '$2');
    return y + z;
}

jQuery(document).on('click', '.arch_submit_price', function () {

    let min_rice = jQuery('.range_input_min').text();
    let max_rice = jQuery('.range_input_max').text();
    let short_min = Number(min_rice) / 1000;
    let short_max = Number(max_rice) / 1000;
    let short_min_s = separate(short_min);
    let short_max_s = separate(short_max);
    let min_text = 'هزار تا';
    if (Number(min_rice) > 999999) {
        min_text = 'میلیون تا'

    }
    let max_text = 'هزار';
    if (Number(max_rice) > 999999) {
        max_text = 'میلیون '

    }
    if (Number(min_rice < Number(max_rice))) {
        jQuery('.price_input').val('' + short_min_s + ' ' + min_text + ' ' + short_max_s + ' ' + max_text);
    }
    jQuery('.price_input_box').css({ 'visibility': 'hidden', 'opacity': '0' })
})
jQuery(document).on('click', '.profile_button', function () {
    let $this = jQuery(this);
    $this.toggleClass('active')
})
jQuery(document).on('click', '.wallet_button', function () {
    let $this = jQuery(this);
    let price = $this.find('.wl_price_inp').val();
    jQuery('.wallet_inp').val(price)


})
jQuery(document).on('click', '#mob_select_date', function () {
    jQuery('.reserve_request_box').css({ 'display': 'block' })


})
jQuery(document).on('click', '#lsearch_mobile', function () {
    var $this = jQuery(this);
    $this.toggleClass('active')
    jQuery('.head_search_mobile').toggleClass('active')


})
jQuery(document).on('click', '.cancel_req_close', function () {
    jQuery('.reserve_request_box').css({ 'display': 'none' })


})
jQuery(document).on('click', '.add_to_favorite', function () {
    let $this = jQuery(this);
    let uird = $this.data('uird');
    let text_elm = $this.find('.atf_title');
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "add_remove_favorite", 'uird': uird }, beforeSend: function () {

        }, success: function (e) {
            if ($this.hasClass('active')) {
                $this.removeClass('active')
                text_elm.text('افزودن به علاقه مندی ها')
            } else {
                $this.addClass('active')
                text_elm.text('افزوده شده به علاقه مندی ها')
            }
        }

    })
})
jQuery(document).on('click', '.remove_favorite', function () {
    let $this = jQuery(this);
    let uird = $this.data('uird');
    let item = $this.parents('.favo_item')

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "remove_favo_page", 'uird': uird }, beforeSend: function () {

        }, success: function (e) {
            item.remove();
        }

    })
})
jQuery(document).on('click', '.login_but', function () {

    jQuery('#login_box').css({ 'opacity': '1', 'visibility': 'visible' })
    jQuery('#dark_box').css({ 'display': 'block' })
})
jQuery(document).on('click', '.monone_login', function () {
    var $this = jQuery(this)
    $this.css({ 'pointer-events': 'none' })

    jQuery('#login_box').css({ 'opacity': '1', 'visibility': 'visible' })
})
jQuery(document).on('click', '.log_box_close', function () {

    jQuery('#login_box').css({ 'opacity': '0', 'visibility': 'hidden' })
    jQuery('#dark_box').css({ 'display': 'none' })
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_register_template" }, beforeSend: function () {

        }, success: function (f) {
            jQuery('#login_box').html(f)
        }

    })
})
jQuery(document).on('keyup', '.opt_numbers', function () {
    let $this = jQuery(this);
    let parents = $this.parents('.opt_box')
    let all_input = parents.find('.opt_numbers');
    let index = $this.attr('data-idx');
    all_input.eq(index).focus();
})
jQuery(document).on('click', '.imn', function (e) {

    e.preventDefault();

    let $this = jQuery(this);
    let mobile_num = jQuery('.tel_enter');
    if (mobile_num.val() === '') {
        jQuery('.log_box_err').text('شماره موبایل خود را وارد کنید.')
    } else {
        $this.css({ 'pointer-events': 'none' })
        jQuery('.log_box_err').text('');
        var mnumber = jQuery('.tel_enter').val()
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "send_mobile_to_check", 'mnumber': mnumber }, beforeSend: function () {

            }, success: function (f) {
                jQuery('#login_box').html(f)
            }

        })

    }

})
jQuery(document).on('click', '.opt_login_submit', function (e) {

    let $this = jQuery(this);
    let parents = $this.parents('#login_box');
    let chile_parent = parents.find('.opt_box .opt_numbers');
    let mnumber = parents.find('.mbn_inp').val();
    let opt_val = [];
    let emty_error = ''
    chile_parent.each(function () {
        let value = jQuery(this).val()
        opt_val.push(value);
        if (value == '') {
            emty_error = 'کاراکتر های رمز یکبار مصرف نباید کمتر از 4 حرف باشد'
            jQuery('.login_form_error').html('<span class="col_red">' + emty_error + '</span>')
        } else {
            jQuery('.login_form_error').html('')
        }
    })

    if (emty_error === '') {
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "check_opt", 'opt': opt_val, 'mnumber': mnumber }, beforeSend: function () {

            }, success: function (d) {

                if (d === 'رمز یکبار مصرف اشتباه وارد شده.' || d === 'زمان استفاده از کد یکبار مصرف به پایان رسیده.') {
                    jQuery('.login_form_error').html('')
                    jQuery('.login_form_error').html('<span class="col_red">' + d + '</span>')
                } else {
                    jQuery('#login_box').html(d)
                }
            }

        })
    }


})

function checkPassword(str) {
    var re = /^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/;

    return re.test(str);
}

jQuery(document).on('click', '.sp_submit', function (e) {
    jQuery('.set_pass_error').html('');
    let $this = jQuery(this);
    let password = jQuery('.set_pass').val();
    let retype_password = jQuery('.retype_pass').val();
    let mobile_number = jQuery('.set_pass_phone').val();
    let error = 0;
    let check_pass = checkPassword(password);
    if (check_pass !== true) {
        jQuery('.set_pass_error').html('<span class="col_red"> فرمت رمزعبور صحیح نیست . رمز عبور باید متشکل از حروف انگلیسی،عدد و  باشد. </span>');

        error = 1;
    } else {
        jQuery('.set_pass_error').html('');
        error = 0;
    }
    if (password !== retype_password) {
        jQuery('.set_pass_error').html('<span class="col_red"> فیلد های پسورد یکسان نیست مجدد وارد نمایید.</span>');
        error = 1;
    } else {
        jQuery('.set_pass_error').html('');
        error = 0;
    }
    if (password == '') {
        error = 1;
        jQuery('.set_pass_error').html('<span class="col_red"> فیلد پسورد را وارد کنید</span>');
    }
    if (retype_password == '') {
        error = 1;
        jQuery('.set_pass_error').html('<span class="col_red"> فیلد تکرار پسورد را وارد کنید.</span>');

    }
    if (error === 0) {

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "create_user_one", 'u_login': mobile_number, 'password': password }, beforeSend: function () {

            }, success: function (d) {
                location.reload();
            }

        })
    }

})
jQuery(document).on('click', '.direct_login', function (e) {

    let $this = jQuery(this);
    let user_name = jQuery('.mbn_inp').val();
    let parents = $this.parents('#login_box');
    let chile_parent = parents.find('.opt_box .opt_numbers');
    let mnumber = parents.find('.mbn_inp').val();
    let opt_val = [];
    let emty_error = '';
    let all_error = 0;
    chile_parent.each(function () {
        let value = jQuery(this).val()
        opt_val.push(value);
        if (value == '') {
            emty_error = 'کاراکتر های رمز یکبار مصرف نباید کمتر از 4 حرف باشد'
            jQuery('.login_form_error').html('<span class="col_red">' + emty_error + '</span>');
            all_error = 1;
        } else {
            jQuery('.login_form_error').html('')
            all_error = 0;
        }
    })

    if (emty_error === '') {
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "check_opt", 'opt': opt_val, 'mnumber': mnumber }, beforeSend: function () {

            }, success: function (d) {

                if (d === 'رمز یکبار مصرف اشتباه وارد شده.' || d === 'زمان استفاده از کد یکبار مصرف به پایان رسیده.') {
                    jQuery('.login_form_error').html('')
                    jQuery('.login_form_error').html('<span class="col_red">' + d + '</span>');
                    all_error = 1;
                } else {
                    jQuery.ajax({
                        url: ajax_data.aju, type: "POST", data: { action: "direct_login", 'user_name': user_name }, beforeSend: function () {

                        }, success: function (d) {
                            location.reload();
                        }

                    })
                }
            }

        })
    }


})

jQuery(document).on('click', '.un_login_submit', function (e) {
    jQuery('.logopt').css({ 'opacity': 0, 'visibility': 'hidden', 'height': '0' })
    jQuery('.logpass').css({ 'opacity': 1, 'visibility': 'visible' })
})


jQuery(document).on('click', '.opt_resend i', function (e) {
    jQuery('.opt_resend i').css({ 'font-size': '12px', 'opacity': '0.5', 'pointer-events': 'none', 'cursor': 'none' });
    let number = jQuery('.mbn_inp').val();
    let opt_time = jQuery('.opt_timer');
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "refresh_opt", 'mnumber': number }, beforeSend: function () {

        }, success: function (f) {

        }

    })
    opt_time.backward_timer('reset')
    opt_time.fadeIn(0)
    opt_time.backward_timer('start')
})


jQuery(document).on('click', '.log_in_pass', function (e) {
    jQuery('.lip_error').html('')
    let $this = jQuery(this);
    let user_name = jQuery('.mbn_inp').val();
    let user_pass_inp = jQuery('.paa_log_inp')
    let user_pass = user_pass_inp.val();
    let error = 0;
    if (user_pass == '') {
        jQuery('.lip_error').html('<span>فیلد پسورد نباید خالی باشد</span>')
        error = 1;
    } else {
        jQuery('.lip_error').html('')
        error = 0;
    }
    if (user_pass.length < 6) {
        jQuery('.lip_error').html('<span class="col_red">فیلد پسورد نمیتواند کمتر از 6 حرف باشد</span>')
        error = 1;
    } else {
        jQuery('.lip_error').html('')
        error = 0;
    }

    if (error == 0) {
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "pass_login", 'user_name': user_name, 'password': user_pass }, beforeSend: function () {

            },

            success: function (d) {
                if (d !== '') {
                    jQuery('.lip_error').html('<span class="col_red">' + d + '</span>')

                } else {
                    location.reload();
                }


            }

        })
    }


})
jQuery(document).on('click', '.mbn_show_edit', function (e) {

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_register_template" }, beforeSend: function () {

        }, success: function (f) {
            jQuery('#login_box').html(f)
        }

    })


})

jQuery(document).on('click', '.change_pass_submit', function (e) {
    let old_pass = jQuery('.inp_old_pass').val();
    let new_pass = jQuery('.inp_new_pass').val();
    let renew_pass = jQuery('.renew_pass').val();
    let error = 0;
    if (old_pass === '') {
        jQuery('.oup_error').html('<span class="col_red fz11 fw300">رمز عبور فعلی خود را وارد کنید</span>')
        error = 1;
    } else {
        jQuery('.oup_error').html('');
        error = 0;
    }
    if (new_pass === '') {
        jQuery('.nup_error').html('<span class="col_red fz11 fw300">رمز عبور فعلی خود را وارد کنید</span>')
        error = 1;
    } else {
        jQuery('.nup_error').html('');
        error = 0;

    }
    if (renew_pass === '') {
        jQuery('.rnup_error').html('<span class="col_red fz11 fw300">رمز عبور فعلی خود را وارد کنید</span>')
        error = 1;

    } else {
        jQuery('.rnup_error').html('');
        error = 0;
    }
    let new_pass_check = checkPassword(new_pass);
    if (new_pass_check !== true) {
        jQuery('.nup_error').html('<span class="col_red fz11 fw300">فرمت و ترکیب رمز عبور ارسالی صحیح نیست</span>')
        error = 1;
    } else {
        jQuery('.nup_error').html('')
        error = 0;
    }
    if (new_pass !== renew_pass) {
        jQuery('.cop_err').html('<span class="col_red fz13 fw500">تکرار رمز عبور با رمز عبور یکسان نیست</span>')
        error = 1;
    } else {
        jQuery('.cop_err span').remove()
        error = 0;
    }

    if (error === 0) {

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "change_user_password", 'new_pass': new_pass, 'old_pass': old_pass }, beforeSend: function () {
                jQuery('.change_pass_submit').text('درحال ذخیره سازی')
            }, success: function (f) {
                if (f !== '') {
                    jQuery('.inp_old_pass').val('')
                    jQuery('.change_pass_submit').text('ذخیره')
                    jQuery('.cop_err').html('<span class="col_red fz13 fw500">' + f + '</span>')

                } else {
                    jQuery('.change_pass_submit').text('ذخیره');
                    jQuery('.inp_old_pass').val('')
                    jQuery('.inp_new_pass').val('')
                    jQuery('.renew_pass').val('')
                    let elem = jQuery('#alert_box');
                    jQuery('#dark_box').fadeIn()
                    elem.css({ 'opacity': '1', 'visibility': 'visible' })
                    elem.append('<i class="fa fa-check ml_10 col_green"></i><p>رمز عبور شما با موفقیت بروز شد.</p>')
                }
            }

        })
    }
})
jQuery(document).on('click', '.change_user_info_submit', function (e) {
    let first_name = jQuery('.a_uname').val();
    let last_name = jQuery('.a_lastname').val();
    let melli_code = jQuery('.mcode').val();
    let gender = jQuery('.gender').val();
    let birth_date = jQuery('.au_date').val();
    let user_mobile = jQuery('.au_mobile').val();
    let user_email = jQuery('.au_email').val();
    let user_phone = jQuery('.au_phone').val();
    let user_description = jQuery('.au_desc').val();
    let bank_cart_num = jQuery('.au_cartnum').val();
    let bank_shaba_num = jQuery('.au_shaba').val();
    let bank_account_name = jQuery('.au_accountname').val();
    let bank_name = jQuery('.au_bank_name').val();


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "update_user_info",
            'first_name': first_name,
            'last_name': last_name,
            'melli_code': melli_code,
            'gender': gender,
            'birth_date': birth_date,
            'user_mobile': user_mobile,
            'user_email': user_email,
            'user_phone': user_phone,
            'user_description': user_description,
            'bank_cart_num': bank_cart_num,
            'bank_shaba_num': bank_shaba_num,
            'bank_account_name': bank_account_name,
            'bank_name': bank_name
        }, beforeSend: function () {
            jQuery('.change_user_info_submit').text('درحال ذخیره اطلاعات...')

        }, success: function (f) {
            let elem = jQuery('#alert_box');
            jQuery('.change_user_info_submit').text('ذخیره')
            jQuery('#dark_box').fadeIn()

            elem.css({ 'opacity': '1', 'visibility': 'visible' })
            elem.append('<i class="fa fa-check ml_10 col_green"></i><p>اطلاعات حساب کاربری شما با موفقیت  بروز شد.</p>')
        }

    })

})
jQuery(document).on('click', '.alert_box_close', function (e) {
    let elem = jQuery('#alert_box');
    let elem_p = jQuery('#alert_box p');
    jQuery('#dark_box').fadeOut()
    elem.css({ 'opacity': '0', 'visibility': 'hidden' })
    elem_p.remove();
    jQuery('.alert_title').remove()
})
jQuery(document).on('click', '.btn_accept_request', function (e) {
    let $this = jQuery(this);
    var pt = '';
    if ($this.hasClass('hpt')) {
        var pt = 'hotel';
    }

    let parents = $this.parents('.request_act_box');
    let parents_wb = $this.parents('.trppb ');
    let oids = parents.find('.oi_h').attr('data-oi');
    let iod = Number(oids) - 100;

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "change_order_ststus", 'oid': iod, 'os': '4', 'pt': pt, 'sc': 'confirm' }, beforeSend: function () {
        }, success: function (f) {
            parents.remove()
            parents_wb.find(' .trb_pay_s10 span ').remove()
            parents_wb.find(' .trb_pay_s10  ').append('<span>در انتظار پرداخت</span>')

        }

    })
})
jQuery(document).on('click', '.btn_cancel_request', function (e) {
    let $this = jQuery(this);
    var pt = '';
    if ($this.hasClass('hpt')) {
        var pt = 'hotel';
    }
    let parents = $this.parents('.request_act_box');
    let parents_wb = $this.parents('.trppb ');
    let oids = parents.find('.oi_h').attr('data-oi');
    let iod = Number(oids) - 100;

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "change_order_ststus", 'oid': iod, 'os': '3', 'pt': pt }, beforeSend: function () {
        }, success: function (f) {
            parents.remove()
            parents_wb.find(' .trb_pay_s10 span ').remove()
            parents_wb.find(' .trb_pay_s10  ').css({ 'background-color': '#d32f2f' })
            parents_wb.find(' .trb_pay_s10  ').append('<span>رد شده از طرف میزبان</span>')
        }

    })
})
jQuery(document).on('click', '.wallet_submit', function (e) {

    jQuery('.up_wallet').submit();
})
jQuery(document).on('click', '.chpp_submit', function (e) {
    jQuery('#formId').submit()
})
jQuery(document).on('click', '.request_payment_submit', function (e) {
    let amount = jQuery('.up_wallet_amount').val();
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_pay_wallet", 'amount': amount, }, beforeSend: function () {


        }, success: function (f) {

            if (f === 'max_order_error') {
                jQuery('#dark_box').fadeIn()
                jQuery('#alert_box ').append('<p>مبلغ درخواستی شما بیش از حد مجاز است.</p>')
                jQuery('#alert_box').css({ 'opacity': 1, 'visibility': 'visible' })
            } else if (f === 'cart_check_nok') {
                var pathname = window.location.pathname.split('/');
                var siteName = pathname[1];
                jQuery('#alert_box ').css({ 'flex-direction': 'column' })
                jQuery('#alert_box ').append('<p>شماره کارت شما وارد نشد و یا صحیح نیست </p>')
                jQuery('#alert_box').append('<a class="rewcart" href="' + window.location.origin + '/' + siteName + '/account">اصلاح یا ثبت شماره کارت</a>');
                jQuery('#alert_box').css({ 'opacity': 1, 'visibility': 'visible' })
            } else {
                jQuery('#dark_box').fadeIn()
                jQuery('#alert_box ').append('<p>درخواست وجه شما با موفقیت ثبت شد.</p>')
                jQuery('#alert_box').css({ 'opacity': 1, 'visibility': 'visible' })
                jQuery('.alert_box_close').on('click', function () {
                    location.reload();
                })
            }

        }

    })
})
jQuery(function ($) {
    $('body').on('change', '#file_user_pic', function () {
        $this = $(this);
        file_data = $(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'file_upload_user_image');
        form_data.append('security', ajax_data.security);

        $.ajax({
            url: ajax_data.aju, type: 'POST', contentType: false, processData: false, data: form_data, success: function (response) {
                $this.val('');
                jQuery.ajax({
                    url: ajax_data.aju, type: 'POST', data: { action: "reload_user_image" }, success: function (data) {
                        jQuery('.user_p_image img').remove()
                        jQuery('.user_p_image').append('<img src="' + data + '" alt="">')
                        jQuery('.pbu_img img').remove()
                        jQuery('.pbu_img').append('<img src="' + data + '" alt="">')

                    }
                });
            }
        });
    });
});
jQuery(document).on('mouseover', '.gallery_big_image img', function (e) {
    jQuery('.gallery_small_image img').css({ 'filter': 'blur(3px)' })

})
jQuery(document).on('mouseleave', '.gallery_big_image img', function (e) {
    jQuery('.gallery_small_image img').css({ 'filter': 'blur(0)' })

})
jQuery(document).on('mouseover', '.gallery_small_image img', function (e) {
    let $this = jQuery(this);

    jQuery('.gallery_small_image img').css({ 'filter': 'blur(3px)' })
    $this.css({ 'filter': 'blur(0)' })


})
jQuery(document).on('mouseleave', '.gallery_small_image img', function (e) {
    jQuery('.gallery_small_image img').css({ 'filter': 'blur(0)' })


})
jQuery(document).on('mouseover', '.gallery_small_image', function (e) {
    let $this = jQuery(this);
    jQuery('.gallery_big_image img').css({ 'filter': 'blur(3px)' })

})
jQuery(document).on('mouseleave', '.gallery_small_image ', function (e) {

    jQuery('.gallery_big_image img').css({ 'filter': 'blur(0)' })

})

jQuery(document).on('click', '.order_pay_submit_but ', function (e) {
    e.preventDefault();
    let name_input = jQuery('.psi_name')
    let lname_input = jQuery('.psi_lastname')
    let phone_input = jQuery('.psi_phone');
    let err = 0;
    if (jQuery('#agree_check').is(':checked')) {
        err = 0;
    } else {
        alert('لطفا گزینه مطالعه قوانین را انتخاب کنید');
    }
    if (name_input.val() === '') {
        name_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        name_input.css({ 'border-color': '#ddd' })
    }
    if (lname_input.val() === '') {
        lname_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        lname_input.css({ 'border-color': '#ddd' })
    }
    if (phone_input.val() === '') {
        err = 1;
        phone_input.css({ 'border-color': '#f44336' })
    } else {
        err = 0;
        phone_input.css({ 'border-color': '#ddd' })
    }

    if (err === 0) {

        jQuery('.order_pay_submit').submit();


    }
})
jQuery(document).on('click', '.order_cash_pay_submit_but ', function (e) {
    e.preventDefault();
    let name_input = jQuery('.psi_name')
    let lname_input = jQuery('.psi_lastname')
    let phone_input = jQuery('.psi_phone');
    let err = 0;
    if (name_input.val() === '') {
        name_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        name_input.css({ 'border-color': '#ddd' })
    }
    if (lname_input.val() === '') {
        lname_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        lname_input.css({ 'border-color': '#ddd' })
    }
    if (phone_input.val() === '') {
        err = 1;
        phone_input.css({ 'border-color': '#f44336' })
    } else {
        err = 0;
        phone_input.css({ 'border-color': '#ddd' })
    }
    if (err === 0) {

        jQuery('.order_cash_pay_submit').submit();


    }

})
jQuery(document).on('click', '.order_cart_pay_submit_but ', function (e) {
    e.preventDefault();
    let name_input = jQuery('.psi_name')
    let lname_input = jQuery('.psi_lastname')
    let phone_input = jQuery('.psi_phone');
    let err = 0;
    if (jQuery('#agree_check').is(':checked')) {
        err = 0;
    } else {
        alert('لطفا گزینه مطالعه قوانین را انتخاب کنید');
    }
    if (name_input.val() === '') {
        name_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        name_input.css({ 'border-color': '#ddd' })
    }
    if (lname_input.val() === '') {
        lname_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        lname_input.css({ 'border-color': '#ddd' })
    }
    if (phone_input.val() === '') {
        err = 1;
        phone_input.css({ 'border-color': '#f44336' })
    } else {
        err = 0;
        phone_input.css({ 'border-color': '#ddd' })

    }
    if (err === 0) {
        let fname = jQuery('.psi_name').val()
        let lname = jQuery('.psi_lastname').val()
        let phone = jQuery('.psi_phone').val();

        jQuery('.order_cart_pay_submit').append('<input type="hidden" name="fname" value="' + fname + '"><input type="hidden" name="lname" value="' + lname + '"><input type="hidden" name="phone" value="' + phone + '">');

        jQuery('.order_cart_pay_submit').submit();


    }

})
jQuery(document).scroll(function () {
    let sct = jQuery(document).scrollTop();
    if (sct > 500) {
        jQuery('.reserve_request_box ').addClass('submit_stick')
    }
    if (sct < 500) {
        jQuery('.reserve_request_box ').removeClass('submit_stick')
    }
});

jQuery(document).scroll(function () {
    let sct = jQuery(document).scrollTop();
    if (sct > 100) {
        jQuery('.mob_head_logo ').css({ 'display': 'none' })
        jQuery('.mob_head_search ').css({ 'position': 'fixed', 'top': '0' })
        jQuery('#mob').css({ 'width': '100%', 'border-radius': '0' })
    }
    if (sct <= 100) {
        jQuery('.mob_head_logo ').css({ 'display': 'flex' })
        jQuery('.mob_head_search ').css({ 'position': 'relative' })
        jQuery('#mob').css({ 'width': 'auto', 'border-radius': '7px' })
    }
});
jQuery(document).scroll(function () {
    let sct = jQuery(document).scrollTop();
    if (sct > 100) {
        jQuery('section.head_top ').addClass('head_fix')
        jQuery('section.head_search').addClass('search_fade')
        jQuery('.user_favo').addClass('fix')
        jQuery('#lsearch').css({ 'opacity': 1, 'visibility': 'visible' })

    }
    if (sct < 100) {
        jQuery('section.head_top ').removeClass('head_fix');
        jQuery('section.head_search').removeClass('search_fade');
        jQuery('.user_favo').removeClass('fix');
        jQuery('#lsearch').css({ 'opacity': 0, 'visibility': 'hidden' })

    }
});

jQuery('#lsearch').on('click', function (e) {
    jQuery('section.head_search').toggleClass('search_fade');
    jQuery('#lsearch').css({ 'opacity': 0, 'visibility': 'hidden' })
})
jQuery('#mob').on('click', function (e) {
    jQuery('.search_mobin').addClass('mob_fix');
    jQuery('#search_box').css({ 'position': 'fixed', 'width': '100%', 'height': '100%' });
})
jQuery('.search_but_close').on('click', function (e) {
    jQuery('.search_mobin').removeClass('mob_fix');
    jQuery('#search_box').css({ 'position': 'unset', 'width': '100%', 'height': '0' });
})
jQuery('.reserve_submit_box a').on('click', function (e) {

    let err = 0;
    let date_in = jQuery('.dpi_inp').val();
    let date_out = jQuery('.dpo_inp').val();
    if (date_in === '') {
        err = 1;
        e.preventDefault();

    }
    if (date_out === '') {
        err = 1;
        e.preventDefault();

    }
})

jQuery(document).on('click', '.wallet_pay', function (e) {
    let $this = jQuery(this);
    var oid = jQuery('.dataoi').val()
    if (oid === undefined) {
        oid = $this.data('oid');
    }
    var amount = jQuery('.up_wallet_amount').val();
    if (amount === undefined) {
        amount = $this.data('amount');
    }
    let name_input = jQuery('.psi_name')
    let lname_input = jQuery('.psi_lastname')
    let phone_input = jQuery('.psi_phone');
    let wallet_type = jQuery('input[name="hotel_wallet"]').val()
    if (wallet_type === undefined) {
        wallet_type = $this.data('type');
    }

    let err = 0;
    if (jQuery('#agree_check').is(':checked')) {
        err = 0;
    } else {
        alert('لطفا گزینه مطالعه قوانین را انتخاب کنید');
    }
    if (name_input.val() === '') {
        name_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        name_input.css({ 'border-color': '#ddd' })
    }
    if (lname_input.val() === '') {
        lname_input.css({ 'border-color': '#f44336' })
        err = 1;
    } else {
        err = 0;
        lname_input.css({ 'border-color': '#ddd' })
    }
    if (phone_input.val() === '') {
        err = 1;
        phone_input.css({ 'border-color': '#f44336' })
    } else {
        err = 0;
        phone_input.css({ 'border-color': '#ddd' })
    }

    if (err === 0) {

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "pay_from_wallet", 'oid': oid, 'amount': amount, 'passenger_name': name_input.val(), 'passenger_famili': lname_input.val(), 'passenger_phone': phone_input.val(), 'wallet_type': wallet_type }, beforeSend: function () {


            }, success: function (f) {
                let url = ajax_data.turl + '/wallet-pay'
                jQuery(location).attr('href', url);
            }

        })


    }


})
jQuery(document).on('click', '.adition_toption i', function (e) {
    let $this = jQuery(this);
    let parents = $this.parents('.adition_toption');
    parents.find('.adito_drop').toggleClass('active')
    // jQuery('.adito_drop').toggleClass('active')
})
jQuery(document).on('click', '.user_cncel_btn ', function (e) {

    jQuery('.adito_drop').removeClass('active');
    let $this = jQuery(this);

    let res_id = $this.data('ri43659') - 100;
    let order_id = $this.data('oi43654') - 100;


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_res_low", 'res_id': res_id, 'order_id': order_id }, beforeSend: function () {


        }, success: function (f) {

            jQuery('.user_cansel_trip_box').html(f)
            jQuery('.user_cansel_trip_box').css({ 'visibility': 'visible', 'opacity': '1' });
        }

    })

})
jQuery(document).on('click', '.user_mapv_btn ', function (e) {


    let $this = jQuery(this);
    let res_id = $this.data('ri43659') - 100;


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_res_map", 'res_id': res_id }, beforeSend: function () {
            let parents = $this.parents('.adito_drop');
            parents.toggleClass('active')

        }, success: function (f) {

            jQuery('.user_cansel_trip_box').html(f)
            jQuery('.user_cansel_trip_box').css({ 'visibility': 'visible', 'opacity': '1' });

        }

    })


})
jQuery(document).on('click', '.user_hmapv_btn ', function (e) {


    let $this = jQuery(this);
    let res_id = $this.data('ri43659') - 100;


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_hres_map", 'res_id': res_id }, beforeSend: function () {
            let parents = $this.parents('.adito_drop');
            parents.toggleClass('active')

        }, success: function (f) {

            jQuery('.user_cansel_trip_box').html(f)
            jQuery('.user_cansel_trip_box').css({ 'visibility': 'visible', 'opacity': '1' });

        }

    })


})
jQuery(document).on('click', '.cancel_trip_btn ', function (e) {


    let $this = jQuery(this);
    let parent = $this.parents('.user_cansel_trip_box');
    let inp = parent.find('.crid');
    let res_id = inp.data('ri43659') - 100;
    let order_id = inp.data('oi43654') - 100;
    var atLeastOneIsChecked = jQuery('input[name="cancel Terms and Conditions"]:checked').length > 0;
    if (atLeastOneIsChecked == false) {
        jQuery('.ctacl').css({ 'color': 'red' })
    } else {
        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calc_res_cancel", 'res_id': res_id, 'order_id': order_id }, beforeSend: function () {


            }, success: function (f) {
                jQuery('.user_cansel_trip_box').css({ 'align-items': 'center', 'justify-content': 'center', 'height': '120px' })
                jQuery('.user_cansel_trip_box').html('<div><span class="cancel_box_close cbcc"><i class="fa fa-close"></i></span></div><div><i class="fa-regular fa-check-circle"></i><span>کاربر گرامی سفر شما با موفقیت لغو شد.</span></div><style>.user_cansel_trip_box{flex-direction: column}</style>')

            }

        })
    }


})
jQuery(document).on('click', '.cansel_trip_box_close ', function (e) {
    jQuery('.user_cansel_trip_box').css({ 'visibility': 'hidden', 'opacity': '0' })
})
jQuery(document).on('click', '.cbcc ', function (e) {
    location.reload();
})

jQuery(document).on('click', '.btn_view_low ', function (e) {
    jQuery('.view_low_box').css({ 'visibility': 'visible', 'opacity': '1' })
})
jQuery(document).on('click', '.cancel_box_close_form ', function (e) {
    jQuery('.view_low_box').css({ 'visibility': 'hidden', 'opacity': '0' })
})

jQuery(document).ready(function ($) {
    jQuery(document).on('click', '#host_insert_post_btn', function () {
        let $this = jQuery(this);
        let post_name = jQuery('.host_name_inp').val();
        let post_Content = tinymce.get("add_hd").getContent();
        let The_area_of_meter = jQuery("input[name=The_area_of_meter]").val();
        let total_area_of_building_meter = jQuery("input[name=total_area_of_building_meter]").val();
        let residence_type = jQuery("select[name=residence_type]").val();
        let reserve_type = jQuery("select[name=reserve_type]").val();
        let cancel_type = jQuery("select[name=cancel_type]").val();
        let base_capacity = jQuery("input[name=base_capacity]").val();
        let total_capacity = jQuery("input[name=total_capacity]").val();
        let number_room = jQuery("input[name=number_room]").val();
        let Single_bed = jQuery("input[name=Single_bed]").val();
        let double_bed = jQuery("input[name=double_bed]").val();
        let mattress = jQuery("input[name=mattress]").val();
        let Bathroom = jQuery("input[name=Bathroom]").val();
        let iranian_toilet = jQuery("input[name=iranian_toilet]").val();
        let sitting_toilet = jQuery("input[name=sitting_toilet]").val();
        let price = jQuery("input[name=price]").val();
        let end_week_price = jQuery("input[name=end_week_price]").val();
        let off_price = jQuery("input[name=off_price]").val();
        let extra_person = jQuery("input[name=extra_person]").val();
        let od_tools = jQuery("input[name=od_tools]").val();
        let od_loyer_get = jQuery("input[name='od_loyer[]']");
        let in_clock = jQuery("select[name=in_clock]").val();
        let res_address = jQuery("input[name=res_address]").val();
        let out_clock = jQuery("select[name=out_clock]").val();
        let map_point_lat = jQuery("input[name=map_point_lat]").val();
        let map_point_lng = jQuery("input[name=map_point_lng]").val();
        let od_loyer = []
        let attach_url = jQuery('.attach_url').val();
        let gallery_urls = [];
        let madarek_urls = [];
        let gallery_arrau = jQuery('.img_box_show_gall .up_gall_host_box ');
        let madarek_array = jQuery('.madarek_box_show_gall .up_gall_host_box_larg ');
        let meli_pic = jQuery('.img_meli_show img').attr('src');

        od_loyer_get.filter(":checked").map(function () {
            od_loyer.push(this.value)
        }).get()

        $.each(gallery_arrau, function (index, element) {
            let img_src = $(element).find('img').attr('src')
            gallery_urls.push(img_src)
        })
        $.each(madarek_array, function (index, element) {
            let madarek_src = $(element).find('img').attr('src')
            madarek_urls.push(madarek_src)
        })

        let city_terms_ids = [];
        let get_terms_city = jQuery("input[name='tax_input[city][]']");
        get_terms_city.filter(":checked").map(function () {
            city_terms_ids.push(this.value)
        }).get()
        let region_terms_ids = [];
        let get_terms_region = jQuery("input[name='tax_input[region][]']");
        get_terms_region.filter(":checked").map(function () {
            region_terms_ids.push(this.value)
        }).get()
        let tools_terms_ids = [];
        let get_terms_tools = jQuery("input[name='tax_input[tools][]']");
        get_terms_tools.filter(":checked").map(function () {
            tools_terms_ids.push(this.value)
        }).get()
        let category_terms_ids = [];
        let get_terms_category = jQuery("input[name='tax_input[categories][]']");
        get_terms_category.filter(":checked").map(function () {
            category_terms_ids.push(this.value)
        }).get()


        jQuery.ajax({
            url: ajax_data.aju,
            type: "POST",
            data: {
                action: "get_my_option",
                'option': 'require_inp_host_insert'
            }
        }).done(function (data) {
            let ndare = Number(data); // تغییر NUMBER به Number
            if (ndare === 1) {
                let fields = [{ name: 'host_name_inp', value: jQuery('.host_name_inp').val(), displayName: 'نام اقامتگاه' }, { name: 'add_hd', value: tinymce.get("add_hd").getContent(), displayName: 'توضیحات اقامتگاه' }, {
                    name: 'price',
                    value: jQuery("input[name=price]").val(),
                    displayName: 'قیمت'
                }, { name: 'end_week_price', value: jQuery("input[name=end_week_price]").val(), displayName: 'قیمت آخر هفته' }, { name: 'res_address', value: jQuery("input[name=res_address]").val(), displayName: 'آدرس' },

                ];
                let arrays = [

                    { name: 'gallery_urls', value: gallery_urls, displayName: 'گالری تصاویر' }, { name: 'madarek_urls', value: madarek_urls, displayName: 'مدارک اقامتگاه' }, { name: 'city_terms_ids', value: city_terms_ids, displayName: 'شهر' }, {
                        name: 'region_terms_ids',
                        value: region_terms_ids,
                        displayName: 'منطقه اقامتگاه'
                    }, { name: 'tools_terms_ids', value: tools_terms_ids, displayName: 'امکانات ' }, { name: 'category_terms_ids', value: category_terms_ids, displayName: 'نوع اقامتگاه' }];

                // فیلتر کردن فیلدهای خالی
                let missingFields = fields.filter(field => !field.value);

                // فیلتر کردن آرایه‌های خالی
                let emptyArrays = arrays.filter(array => array.value.length === 0);

                if (missingFields.length > 0 || emptyArrays.length > 0) {
                    let messages = [];

                    // افزودن پیام برای فیلدهای خالی
                    missingFields.forEach(field => {
                        messages.push(`${field.displayName} را پر کنید `);
                    });

                    // افزودن پیام برای آرایه‌های خالی
                    emptyArrays.forEach(array => {
                        messages.push(`${array.displayName} آیتم ها را انتخاب کنید.`);
                    });

                    alert(messages.join('\n'));  // نمایش پیام‌ها در هر خط جداگانه
                } else {
                    jQuery.ajax({
                        url: ajax_data.aju, type: "POST", data: {
                            action: "custom_insert_post",
                            'post_title': post_name,
                            'post_content': post_Content,
                            'The_area_of_meter': The_area_of_meter,
                            'total_area_of_building_meter': total_area_of_building_meter,
                            'residence_type': residence_type,
                            'reserve_type': reserve_type,
                            'cancel_type': cancel_type,
                            'base_capacity': base_capacity,
                            'total_capacity': total_capacity,
                            'number_room': number_room,
                            'Single_bed': Single_bed,
                            'double_bed': double_bed,
                            'mattress': mattress,
                            'Bathroom': Bathroom,
                            'iranian_toilet': iranian_toilet,
                            'sitting_toilet': sitting_toilet,
                            'price': price,
                            'end_week_price': end_week_price,
                            'off_price': off_price,
                            'extra_person': extra_person,
                            'od_tools': od_tools,
                            'od_loyer': od_loyer,
                            'in_clock': in_clock,
                            'res_address': res_address,
                            'out_clock': out_clock,
                            'map_point_lat': map_point_lat,
                            'map_point_lng': map_point_lng,
                            'attach_url': attach_url,
                            'gallery_urls': gallery_urls,
                            'city_terms': city_terms_ids,
                            'region_terms_ids': region_terms_ids,
                            'tools_terms_ids': tools_terms_ids,
                            'category_terms_ids': category_terms_ids,
                            'meli_pic': meli_pic,
                            'madarek_urls': madarek_urls

                        }, beforeSend: function () {
                            jQuery('#host_insert_post_btn').text('در حال ذخیره سازی')
                        }, success: function (data) {
                            jQuery('#host_insert_post_btn').text('ذخیره');
                            let url = ajax_data.turl + '/my-host'
                            jQuery(location).attr('href', url);
                        }
                    })
                }
            } else {
                jQuery.ajax({
                    url: ajax_data.aju, type: "POST", data: {
                        action: "custom_insert_post",
                        'post_title': post_name,
                        'post_content': post_Content,
                        'The_area_of_meter': The_area_of_meter,
                        'total_area_of_building_meter': total_area_of_building_meter,
                        'residence_type': residence_type,
                        'reserve_type': reserve_type,
                        'cancel_type': cancel_type,
                        'base_capacity': base_capacity,
                        'total_capacity': total_capacity,
                        'number_room': number_room,
                        'Single_bed': Single_bed,
                        'double_bed': double_bed,
                        'mattress': mattress,
                        'Bathroom': Bathroom,
                        'iranian_toilet': iranian_toilet,
                        'sitting_toilet': sitting_toilet,
                        'price': price,
                        'end_week_price': end_week_price,
                        'off_price': off_price,
                        'extra_person': extra_person,
                        'od_tools': od_tools,
                        'od_loyer': od_loyer,
                        'in_clock': in_clock,
                        'res_address': res_address,
                        'out_clock': out_clock,
                        'map_point_lat': map_point_lat,
                        'map_point_lng': map_point_lng,
                        'attach_url': attach_url,
                        'gallery_urls': gallery_urls,
                        'city_terms': city_terms_ids,
                        'region_terms_ids': region_terms_ids,
                        'tools_terms_ids': tools_terms_ids,
                        'category_terms_ids': category_terms_ids,
                        'meli_pic': meli_pic,
                        'madarek_urls': madarek_urls

                    }, beforeSend: function () {
                        jQuery('#host_insert_post_btn').text('در حال ذخیره سازی')
                    }, success: function (data) {
                        jQuery('#host_insert_post_btn').text('ذخیره');
                        let url = ajax_data.turl + '/my-host'
                        jQuery(location).attr('href', url);
                    }
                })
            }
        });



    });


})

jQuery(document).ready(function ($) {
    jQuery(document).on('click', '#host_update_post_btn', function () {
        let $this = jQuery(this);
        let post_name = jQuery('.host_name_inp').val();
        let post_Content = tinymce.get("add_hd").getContent();
        let The_area_of_meter = jQuery("input[name=The_area_of_meter]").val();
        let total_area_of_building_meter = jQuery("input[name=total_area_of_building_meter]").val();
        let residence_type = jQuery("select[name=residence_type]").val();
        let reserve_type = jQuery("select[name=reserve_type]").val();
        let cancel_type = jQuery("select[name=cancel_type]").val();
        let base_capacity = jQuery("input[name=base_capacity]").val();
        let total_capacity = jQuery("input[name=total_capacity]").val();
        let number_room = jQuery("input[name=number_room]").val();
        let Single_bed = jQuery("input[name=Single_bed]").val();
        let double_bed = jQuery("input[name=double_bed]").val();
        let mattress = jQuery("input[name=mattress]").val();
        let Bathroom = jQuery("input[name=Bathroom]").val();
        let iranian_toilet = jQuery("input[name=iranian_toilet]").val();
        let sitting_toilet = jQuery("input[name=sitting_toilet]").val();
        let price = jQuery("input[name=price]").val();
        let end_week_price = jQuery("input[name=end_week_price]").val();
        let off_price = jQuery("input[name=off_price]").val();
        let extra_person = jQuery("input[name=extra_person]").val();
        let od_tools = jQuery("input[name=od_tools]").val();
        let od_loyer_get = jQuery("input[name='od_loyer[]']");
        let in_clock = jQuery("select[name=in_clock]").val();
        let res_address = jQuery("input[name=res_address]").val();
        let out_clock = jQuery("select[name=out_clock]").val();
        let map_point_lat = jQuery("input[name=map_point_lat]").val();
        let map_point_lng = jQuery("input[name=map_point_lng]").val();
        let od_loyer = []
        let attach_url = jQuery('.attach_url').val();
        let gallery_urls = [];
        let madarek_urls = [];
        let gallery_arrau = jQuery('.img_box_show_gall .up_gall_host_box ');
        let madarek_array = jQuery('.madarek_box_show_gall .up_gall_host_box_larg ');
        let meli_pic = jQuery('.img_meli_show img').attr('src');
        var post_id = GetURLParameter('ri');
        od_loyer_get.filter(":checked").map(function () {
            od_loyer.push(this.value)
        }).get()

        $.each(gallery_arrau, function (index, element) {
            let img_src = $(element).find('img').attr('src')
            gallery_urls.push(img_src)
        })
        $.each(madarek_array, function (index, element) {
            let madarek_src = $(element).find('img').attr('src')
            madarek_urls.push(madarek_src)
        })

        let city_terms_ids = [];
        let get_terms_city = jQuery("input[name='tax_input[city][]']");
        get_terms_city.filter(":checked").map(function () {
            city_terms_ids.push(this.value)
        }).get()

        let region_terms_ids = [];
        let get_terms_region = jQuery("input[name='tax_input[region][]']");
        get_terms_region.filter(":checked").map(function () {
            region_terms_ids.push(this.value)
        }).get()
        let tools_terms_ids = [];
        let get_terms_tools = jQuery("input[name='tax_input[tools][]']");
        get_terms_tools.filter(":checked").map(function () {
            tools_terms_ids.push(this.value)
        }).get()
        let category_terms_ids = [];
        let get_terms_category = jQuery("input[name='tax_input[categories][]']");
        get_terms_category.filter(":checked").map(function () {
            category_terms_ids.push(this.value)
        }).get()


        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: {
                action: "custom_post_update",
                'post_title': post_name,
                'post_content': post_Content,
                'The_area_of_meter': The_area_of_meter,
                'total_area_of_building_meter': total_area_of_building_meter,
                'residence_type': residence_type,
                'reserve_type': reserve_type,
                'cancel_type': cancel_type,
                'base_capacity': base_capacity,
                'total_capacity': total_capacity,
                'number_room': number_room,
                'Single_bed': Single_bed,
                'double_bed': double_bed,
                'mattress': mattress,
                'Bathroom': Bathroom,
                'iranian_toilet': iranian_toilet,
                'sitting_toilet': sitting_toilet,
                'price': price,
                'end_week_price': end_week_price,
                'off_price': off_price,
                'extra_person': extra_person,
                'od_tools': od_tools,
                'od_loyer': od_loyer,
                'in_clock': in_clock,
                'res_address': res_address,
                'out_clock': out_clock,
                'map_point_lat': map_point_lat,
                'map_point_lng': map_point_lng,
                'attach_url': attach_url,
                'gallery_urls': gallery_urls,
                'city_terms': city_terms_ids,
                'region_terms_ids': region_terms_ids,
                'tools_terms_ids': tools_terms_ids,
                'category_terms_ids': category_terms_ids,
                'meli_pic': meli_pic,
                'madarek_urls': madarek_urls,
                'post_id': post_id

            }, beforeSend: function () {
                jQuery('#host_update_post_btn').text('درحال دخیره سازی')
            }, success: function (data) {
                // Trigger price map rebuild to immediately reflect weekend pricing on calendars
                jQuery.ajax({
                    url: ajax_data.aju,
                    type: 'POST',
                    data: {
                        action: 'rebuild_resistance_calender',
                        pid: jQuery('#host_update_post_btn').data('pid') || (new URLSearchParams(window.location.search)).get('ri'),
                        price: jQuery('input[name=price]').val(),
                        end_week_price: jQuery('input[name=end_week_price]').val()
                    },
                    complete: function(){ jQuery('#host_update_post_btn').text('ذخیره') }
                })
            }
        })
    })
})
// jQuery(document).keydown(function (event) {
//     if (event.keyCode == 123) { // Prevent F12
//         return false;
//     } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
//         return false;
//     }
// });
// jQuery(document).on("contextmenu", function (e) {
//     e.preventDefault();
// });
jQuery(function ($) {
    jQuery(document).on('change', '#file', function () {
        $this = $(this);
        file_data = $(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'file_upload');
        form_data.append('security', ajax_data.security);
        file_size = $('#file')[0].files[0].size;
        if (file_size < 10000000) {
            jQuery.ajax({
                url: ajax_data.aju, type: 'POST', contentType: false, processData: false, data: form_data, beforeSend: function () {
                    jQuery('.rorp_not .rorp_notic').text('در حال بارگذاری ....')

                }, success: function (response) {
                    console.log(response)
                    let parent = $this.parents('.up_feauture_imgage_box')
                    jQuery('.rorp_not .rorp_notic').text('')
                    parent.find('.thumbnailUpload').css({ 'display': 'none' })
                    parent.find('.attach_url').val(response)
                    parent.find('.img_box_show').html('<div class="up_single_host_box"><img src="' + response + '"><i class="fa fa-close"></i></div>')
                }
            });
        } else {
            alert('اندازه فایل بزرگتر از حد محاز است')
        }


    });
});
jQuery(function ($) {
    jQuery(document).on('change', '#melli_file', function () {
        $this = $(this);
        file_data = $(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'file_upload');
        form_data.append('security', ajax_data.security);

        jQuery.ajax({
            url: ajax_data.aju, type: 'POST', contentType: false, processData: false, data: form_data, success: function (response) {
                let parent = $this.parents('.up_feauture_imgage_box')
                parent.find('.thumbnailUpload').css({ 'display': 'none' })
                parent.find('.attach_url').val(response)
                parent.find('.img_meli_show').html('<div class="up_meli_host_box"><img src="' + response + '"><i class="fa fa-close"></i></div>')
            }
        });
    });
});
jQuery(function ($) {
    jQuery('body').on('change', '#files', function () {
        $this = $(this);
        file_data = $(this).prop('files');
        form_data = new FormData();
        var ins = document.getElementById('files').files.length;
        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('files').files[x]);
        }

        form_data.append('files', file_data);
        form_data.append('action', 'file_uploads');
        form_data.append('security2', ajax_data.security2);

        jQuery.ajax({
            url: ajax_data.aju, type: 'POST', contentType: false, processData: false, data: form_data, beforeSend: function () {
                jQuery('.gup_not .gup_notic').text('در حال بارگذاری ....')

            }, success: function (response) {
                let urls = JSON.parse(response);
                let parent = $this.parents('.up_feauture_imgage_box')
                let ibs = parent.find('.img_box_show_gall');
                jQuery('.gup_not .gup_notic').text('')

                $.each(urls, function (index, element) {

                    ibs.append('<div class="up_gall_host_box"><img src="' + element + '"><i class="fa fa-close"></i></div>')

                })
            }
        });
    });
});
jQuery(function ($) {
    jQuery('body').on('change', '#madarek_files', function () {
        $this = $(this);
        file_data = $(this).prop('madarek_files');
        form_data = new FormData();
        var ins = document.getElementById('madarek_files').files.length;
        for (var x = 0; x < ins; x++) {
            form_data.append("files[]", document.getElementById('madarek_files').files[x]);
        }

        form_data.append('files', file_data);
        form_data.append('action', 'file_uploads');
        form_data.append('security2', ajax_data.security2);

        jQuery.ajax({
            url: ajax_data.aju, type: 'POST', contentType: false, processData: false, data: form_data, success: function (response) {
                let urls = JSON.parse(response);
                let parent = $this.parents('.up_feauture_imgage_box')
                let ibs = parent.find('.madarek_box_show_gall');


                $.each(urls, function (index, element) {

                    ibs.append('<div class="up_gall_host_box_larg"><img src="' + element + '"><i class="fa fa-close"></i></div>')

                })
            }
        });
    });
});
jQuery(function ($) {
    jQuery(document).on('change', '#Receipt_upload', function () {

        $this = $(this);
        file_data = $(this).prop('files')[0];
        form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('action', 'Receipt_upload');
        form_data.append('security3', ajax_data.security3);

        jQuery.ajax({
            url: ajax_data.aju, type: 'POST', contentType: false, processData: false, data: form_data, success: function (response) {
                let parent = $this.parents('.up_feauture_imgage_box')
                parent.find('.thumbnailUpload').css({ 'display': 'none' })
                parent.find('.attach_url').val(response)
                jQuery('.imageReceipt_show').html('<div class="up_meli_host_box"><img class="w60p" src="' + response + '"><i class="fa fa-close"></i></div>')
            }
        });
    });
});
jQuery(document).on('click', '.up_single_host_box i', function () {
    let $this = jQuery(this);
    let parents = $this.parents('.up_single_host_box');
    parents.remove();
    jQuery('.thumbnailUpload').css({ 'display': 'block' })
    jQuery('#file').val('');
})
jQuery(document).on('click', '.up_meli_host_box i', function () {
    let $this = jQuery(this);
    let parents = $this.parents('.up_meli_host_box');
    parents.remove();
    jQuery('.thumbnailUpload').css({ 'display': 'block' })
    jQuery('#melli_file').val('');
})
jQuery(document).on('click', '.cr-host', function () {
    let $this = jQuery(this);
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "change_user_rol_host" }, beforeSend: function () {


        }, success: function (f) {

            if (f === 'mob') {
                var ch = 'macount'
            }
            if (f === 'desc') {
                var ch = 'account'
            }
            let url = ajax_data.turl + '/' + ch
            jQuery(location).attr('href', url);
        }

    })
})
jQuery(document).on('click', '.up_gall_host_box i', function () {
    let $this = jQuery(this);
    let parents = $this.parents('.up_gall_host_box');
    parents.remove()

    // jQuery('.thumbnailUpload').css({'display': 'block'})

})
jQuery(document).on('click', '.up_gall_host_box_larg i', function () {

    let $this = jQuery(this);
    let parents = $this.parents('.up_gall_host_box_larg');
    parents.remove()

    // jQuery('.thumbnailUpload').css({'display': 'block'})

})
jQuery(document).on('click', '.plus_i', function () {

    let $this = jQuery(this);
    let parents = $this.parents('.pm_box');
    let elem = parents.find('input');
    let input_val = elem.val();
    elem.val(Number(input_val) + 1)

    // jQuery('.thumbnailUpload').css({'display': 'block'})

})
jQuery(document).on('click', '.minus_i', function () {
    let $this = jQuery(this);
    let parents = $this.parents('.pm_box');
    let elem = parents.find('input');
    let input_val = elem.val();
    if (Number(input_val >= 1)) {
        elem.val(Number(input_val) - 1)
    }


    // jQuery('.thumbnailUpload').css({'display': 'block'})

})

jQuery(document).on('click', '.non_log_submit', function () {
    jQuery('#login_box').css({ 'opacity': '1', 'visibility': 'visible' })
    jQuery('#dark_box').css({ 'display': 'block' })

})

jQuery(document).on('click', '.mgtouch', function () {
    jQuery('.sli_full_image').css({ 'opacity': '1', 'visibility': 'visible' })


})

jQuery(document).on('click', '.sli_close ', function () {
    jQuery('.sli_full_image').css({ 'opacity': '0', 'visibility': 'hidden' })


})
jQuery(document).on('click', '.add_to_favorite_none', function () {
    jQuery('#login_box').css({ 'opacity': '1', 'visibility': 'visible' })
    jQuery('#dark_box').css({ 'display': 'block' })

})
jQuery(document).on('click', '.reserv_submit_btn ', function () {
    let $this = jQuery(this);
    let hotel_id = $this.data('hid');
    let adult = Number(jQuery('.adult_num').text())
    let under_tow_num = Number(jQuery('.under_tow_num').text())
    let chil2_6 = Number(jQuery('.chil2_6').text())
    let child_up_six = Number(jQuery('.child_up_six').text())
    var date_in = jQuery('#hsearch_date_in_input').val();
    let date_out = jQuery('#hsearch_date_out_input').val();
    let check = '';
    if (date_in === '' && date_out === '') {
        check = 'false'
    } else {
        check = 'true';
    }

    var all_chield_num = under_tow_num + chil2_6 + child_up_six;

    if (check === 'true') {
        jQuery.ajax({
            url: ajax_data.aju, type: "POST",

            data: { action: "get_rooms_hotel", 'hotel_id': hotel_id, 'sum_chield': all_chield_num, 'adult': Number(adult), 'chil2_6': Number(chil2_6), 'child_up_six': Number(child_up_six), 'under_tow_num': Number(under_tow_num), 'date_in': date_in, 'date_out': date_out }, beforeSend: function () {

            }, success: function (f) {


                jQuery('.not_post_found').html(f)
                jQuery('.cancel_req_close').click()


            }
        })
    }

})

jQuery(document).on('click', '.humber_menu', function () {
    jQuery('.humber_overbox').css({ 'right': '0' })

})
jQuery(document).on('click', '.humber_close', function () {
    jQuery('.humber_overbox').css({ 'right': '-60%' })

})
jQuery(document).on('click', '.is_parent', function () {
    jQuery('.pdp-picker').css({ 'display': 'none' })
})
jQuery(document).on('click', '.pn_input fillimp', function () {

})
jQuery(document).on('mousedown', '.pass_eye', function () {

    var $this = jQuery(this);
    var parent = $this.parents('.paaes_input');
    var inp = parent.find('.inppss');
    inp.prop("type", "text");

})
jQuery(document).on('mouseup', '.pass_eye', function () {
    var $this = jQuery(this);
    var parent = $this.parents('.paaes_input');
    var inp = parent.find('.inppss');
    inp.prop("type", "password");

})
jQuery(".reserv_submit_btn").click(function () {
    jQuery('html,body').animate({
        scrollTop: jQuery(".room_cbox").offset().top
    }, 'slow');
});

jQuery(".inpcheck").change(function () {
    let $this = jQuery(this);
    let parent = $this.parents('.citbox');
    let element = parent.find('img')
    if (this.checked) {
        element.css({ 'border': '2px solid red' })
    } else {
        element.css({ 'border': 'none' })
    }
});

function GetURLParameter(sParam) {
    var sPageURL = window.location.search.substring(1);
    var sURLVariables = sPageURL.split('&');
    for (var i = 0; i < sURLVariables.length; i++) {
        var sParameterName = sURLVariables[i].split('=');
        if (sParameterName[0] == sParam) {
            return decodeURIComponent(sParameterName[1]);
        }
    }
}

jQuery(document).mouseup(function (e) {
    var container = jQuery(".profile_button");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.removeClass('active');
    }
});
jQuery(document).mouseup(function (e) {
    var container = jQuery("#dpin");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.in_calender').css({ 'display': 'none' });
    }
});
jQuery(document).mouseup(function (e) {
    var container = jQuery("#dpout");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.out_calender').css({ 'display': 'none' });
    }
});

jQuery(document).mouseup(function (e) {
    var container = jQuery(".srarch_num_people");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.sbox').css({ 'display': 'none' });
    }
});
jQuery(document).mouseup(function (e) {
    var container = jQuery(".pinp");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.pn_input_box').css({ 'display': 'none' });
    } else {
        container.find('.pn_input_box').css({ 'display': 'block' });
    }
});
jQuery(document).mouseup(function (e) {
    var container = jQuery(".price_filter");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.price_input_box').css({ 'visibility': 'hidden', 'opacity': 0 });
    } else {
        container.find('.price_input_box').css({ 'visibility': 'visible', 'opacity': 1 });
    }
});

jQuery(document).mouseup(function (e) {
    var container = jQuery(".srarch_city");
    if (!container.is(e.target) && container.has(e.target).length === 0) {
        container.find('.search_result').css({ 'display': 'none' });
    }
});

jQuery('.dpi_inp').attr('readonly', 'readonly');
jQuery('.dpo_inp').attr('readonly', 'readonly');
jQuery('.pdp-input').attr('readonly', 'readonly');
jQuery('.fillimp').attr('readonly', 'readonly');
jQuery('.price_input ').attr('readonly', 'readonly');

jQuery(window).on('load', function () {
    var number;
    setInterval(function () {
        number = Math.floor((Math.random() * 7));
        var rand_box = jQuery('.tile_image_inner');
        var rand_items = rand_box.find('figure img');


        var rand_sec = rand_box.find('.tile_fig');
        var index_data = rand_box.find("[data-sec='" + number + "']");
        var index_img = index_data.find('img');
        rand_items.css({ 'opacity': 0.6 })
        index_img.css({ 'opacity': 1 })

    }, 1500);
});

jQuery(document).ready(function ($) {
    jQuery(document).on('click', '#hotel_insert_post_btn', function () {
        let $this = jQuery(this);
        let post_name = jQuery('.hotel_name_inp').val();
        let post_Content = tinymce.get("add_hot").getContent();
        let reserve_type = jQuery("select[name=hotel_reserve_type]").val();
        let hotel_stars = jQuery("select[name=hotel_stars]").val();
        let child_bed_need = jQuery("select[name=child_bed_need]").val();
        let in_clock = jQuery("select[name=in_clock]").val();
        let out_clock = jQuery("select[name=out_clock]").val();
        let od_loyer_get = jQuery("input[name='od_loyer[]']");
        let hotel_address = jQuery("input[name=hotel_name_inp]").val();
        let map_point_lat = jQuery("input[name=map_point_lat]").val();
        let map_point_lng = jQuery("input[name=map_point_lng]").val();
        let od_loyer = []
        let attach_url = jQuery('.attach_url').val();
        let gallery_urls = [];
        let madarek_urls = [];
        let gallery_arrau = jQuery('.img_box_show_gall .up_gall_host_box ');
        let madarek_array = jQuery('.madarek_box_show_gall .up_gall_host_box_larg ');
        let meli_pic = jQuery('.img_meli_show img').attr('src');
        // od_loyer_get.filter(":checked").map(function () {
        //     od_loyer.push(this.value)
        // }).get()
        $.each(gallery_arrau, function (index, element) {
            let img_src = $(element).find('img').attr('src')
            gallery_urls.push(img_src)
        })
        $.each(madarek_array, function (index, element) {
            let madarek_src = $(element).find('img').attr('src')
            madarek_urls.push(madarek_src)
        })
        let city_terms_ids = [];
        let get_terms_city = jQuery("input[name='tax_input[city_hotel][]']");
        get_terms_city.filter(":checked").map(function () {
            city_terms_ids.push(this.value)
        }).get()
        let loyer_terms_ids = [];
        let get_terms_loyer = jQuery("input[name='tax_input[od_loyer][]']");
        get_terms_loyer.filter(":checked").map(function () {
            loyer_terms_ids.push(this.value)
        }).get()

        let tools_terms_ids = [];
        let get_terms_tools = jQuery("input[name='tax_input[hotel_tools][]']");
        get_terms_tools.filter(":checked").map(function () {
            tools_terms_ids.push(this.value)
        }).get()

        let category_terms_ids = [];
        let get_terms_category = jQuery("input[name='tax_input[hotel_category][]']");
        get_terms_category.filter(":checked").map(function () {
            category_terms_ids.push(this.value)
        }).get()

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: {
                action: "hotel_insert_post",
                'post_title': post_name,
                'post_content': post_Content,
                'reserve_type': reserve_type,
                'hotel_stars': hotel_stars,
                'od_loyer': od_loyer,
                'in_clock': in_clock,
                'hotel_address': hotel_address,
                'out_clock': out_clock,
                'map_point_lat': map_point_lat,
                'map_point_lng': map_point_lng,
                'attach_url': attach_url,
                'gallery_urls': gallery_urls,
                'city_terms': city_terms_ids,
                'tools_terms_ids': tools_terms_ids,
                'category_terms_ids': category_terms_ids,
                'meli_pic': meli_pic,
                'madarek_urls': madarek_urls,
                'child_bed_need': child_bed_need,
                'loyer_terms_ids': loyer_terms_ids

            }, beforeSend: function () {
                jQuery('#hotel_insert_post_btn').text('در حال ذخیره سازی')
            }, success: function (data) {
                jQuery('#hotel_insert_post_btn').text('ذخیره');
                let url = ajax_data.turl + '/my-hotel'
                jQuery(location).attr('href', url);
            }
        })
    })
})
jQuery(document).ready(function ($) {
    jQuery(document).on('click', '#hotel_update_post_btn', function () {
        let $this = jQuery(this);
        let post_name = jQuery('.hotel_name_inp').val();
        let post_Content = tinymce.get("add_hot").getContent();
        let reserve_type = jQuery("select[name=hotel_reserve_type]").val();
        let hotel_stars = jQuery("select[name=hotel_stars]").val();
        let child_bed_need = jQuery("select[name=child_bed_need]").val();
        let in_clock = jQuery("select[name=in_clock]").val();
        let out_clock = jQuery("select[name=out_clock]").val();
        let od_loyer_get = jQuery("input[name='od_loyer[]']");
        let hotel_address = jQuery("input[name=hotel_name_inp]").val();
        let map_point_lat = jQuery("input[name=map_point_lat]").val();
        let map_point_lng = jQuery("input[name=map_point_lng]").val();
        let od_loyer = []
        let attach_url = jQuery('.attach_url').val();
        let gallery_urls = [];
        let madarek_urls = [];
        let gallery_arrau = jQuery('.img_box_show_gall .up_gall_host_box ');
        let madarek_array = jQuery('.madarek_box_show_gall .up_gall_host_box_larg ');
        let meli_pic = jQuery('.img_meli_show img').attr('src');
        var post_id = GetURLParameter('ri');

        // od_loyer_get.filter(":checked").map(function () {
        //     od_loyer.push(this.value)
        // }).get()
        $.each(gallery_arrau, function (index, element) {
            let img_src = $(element).find('img').attr('src')
            gallery_urls.push(img_src)
        })
        $.each(madarek_array, function (index, element) {
            let madarek_src = $(element).find('img').attr('src')
            madarek_urls.push(madarek_src)
        })
        let city_terms_ids = [];
        let get_terms_city = jQuery("input[name='tax_input[city_hotel][]']");
        get_terms_city.filter(":checked").map(function () {
            city_terms_ids.push(this.value)
        }).get()
        let loyer_terms_ids = [];
        let get_terms_loyer = jQuery("input[name='tax_input[od_loyer][]']");
        get_terms_loyer.filter(":checked").map(function () {
            loyer_terms_ids.push(this.value)
        }).get()

        let tools_terms_ids = [];
        let get_terms_tools = jQuery("input[name='tax_input[hotel_tools][]']");
        get_terms_tools.filter(":checked").map(function () {
            tools_terms_ids.push(this.value)
        }).get()

        let category_terms_ids = [];
        let get_terms_category = jQuery("input[name='tax_input[hotel_category][]']");
        get_terms_category.filter(":checked").map(function () {
            category_terms_ids.push(this.value)
        }).get()

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: {
                action: "hotel_update_post",
                'post_title': post_name,
                'post_content': post_Content,
                'reserve_type': reserve_type,
                'hotel_stars': hotel_stars,
                'od_loyer': od_loyer,
                'in_clock': in_clock,
                'hotel_address': hotel_address,
                'out_clock': out_clock,
                'map_point_lat': map_point_lat,
                'map_point_lng': map_point_lng,
                'attach_url': attach_url,
                'gallery_urls': gallery_urls,
                'city_terms': city_terms_ids,
                'tools_terms_ids': tools_terms_ids,
                'category_terms_ids': category_terms_ids,
                'meli_pic': meli_pic,
                'madarek_urls': madarek_urls,
                'child_bed_need': child_bed_need,
                'loyer_terms_ids': loyer_terms_ids,
                'post_id': post_id

            }, beforeSend: function (data) {

                jQuery('#hotel_update_post_btn').text('در حال ذخیره سازی')
            }, success: function (data) {

                jQuery('#hotel_update_post_btn').text('ذخیره');
                let url = ajax_data.turl + '/my-hotel'
                jQuery(location).attr('href', url);

            }
        })
    })
})
jQuery(document).on('click', '.add_room', function () {
    let $this = jQuery(this);
    let pid = $this.data('pid');

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_new_room_template", 'pid': pid }, beforeSend: function () {


        }, success: function (data) {
            jQuery('.room_item_box_prbox').append(data)
        }

    })

})

jQuery(document).on('click', '.save_room', function () {
    let $this = jQuery(this);
    let pid = $this.data('pid');
    let parent = $this.parents('.room_pbox ');
    let items = parent.find('.room_item_box_prbox .rooms_inner ');

    items.each(function (index, element) {

        let room_number = jQuery(this).data('rnum');
        let room_name = jQuery(this).find('.room_name').val();
        let bed_count = jQuery(this).find('.room_on_bed').val();
        let room_breackfast = jQuery(this).find('.room_breackfast');
        if (room_breackfast.is(':checked')) {
            room_breackfast = 'on';
        } else {
            room_breackfast = 'off';
        }
        let room_lunch = jQuery(this).find('.room_lunch');
        if (room_lunch.is(':checked')) {
            room_lunch = 'on';
        } else {
            room_lunch = 'off';
        }
        let room_Dinner = jQuery(this).find('.room_Dinner');
        if (room_Dinner.is(':checked')) {
            room_Dinner = 'on';
        } else {
            room_Dinner = 'off';
        }
        let room_normal_price = jQuery(this).find('.room_normal_price').val();
        let room_endWeek_price = jQuery(this).find('.room_endWeek_price').val();


        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: {
                action: "hotel_save_rooms",
                'room_number': room_number,
                'pid': pid,
                'room_name': room_name,
                'bed_count': bed_count,
                'room_breackfast': room_breackfast,
                'room_lunch': room_lunch,
                'room_Dinner': room_Dinner,
                'room_normal_price': room_normal_price,
                'room_endWeek_price': room_endWeek_price,

            }, beforeSend: function () {

                jQuery('.save_room ').text('در حال ذخیره سازی')
            }, success: function (data) {
                jQuery('.save_room ').text('ذخیره')
            }

        })
    })

})
jQuery(document).on('click', '.hadd_room', function () {
    let $this = jQuery(this);
    let pid = $this.data('pid');

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_new_hroom_template", 'pid': pid },

        beforeSend: function () {


        }, success: function (response) {
            // console.log(response)
            jQuery('.no_item').css({ 'display': 'none' })
            jQuery('.room_item_box_prbox').append(response)
        }

    })

})
jQuery(document).on('click', '.hsave_room ', function () {
    let $this = jQuery(this);
    let pid = $this.data('pid');
    let parent = $this.parents('.room_pbox ');
    let items = parent.find('.room_item_box_prbox .rooms_inner ');
    let room_single_bed = parent.find('.room_single_bed').val();
    let room_Double_bed = parent.find('.room_Double_bed').val();
    let room_breackfast = parent.find('.room_breackfast');
    let r_short_desc = parent.find('.r_short_desc').val();


    items.each(function (index, element) {

        let room_number = jQuery(this).data('rnum');
        let room_name = jQuery(this).find('.room_name').val();
        let room_tip_number = jQuery(this).find('.r_tips_number').val()
        let bed_count = jQuery(this).find('.room_on_bed').val();
        let room_breackfast = jQuery(this).find('.room_breackfast');
        let r_gallery = jQuery(this).find('.imageContainer img');

        let gurls = []
        jQuery(r_gallery).each(function () {
            var src = jQuery(this).attr('src');
            var parts = src.split('/');
            var lastThreeParts = parts.slice(-3);
            var url = lastThreeParts.join('/');
            gurls.push(url)
        });

        if (room_breackfast.is(':checked')) {
            room_breackfast = 'on';
        } else {
            room_breackfast = 'off';
        }
        let room_lunch = jQuery(this).find('.room_lunch');
        if (room_lunch.is(':checked')) {
            room_lunch = 'on';
        } else {
            room_lunch = 'off';
        }
        let room_Dinner = jQuery(this).find('.room_Dinner');
        if (room_Dinner.is(':checked')) {
            room_Dinner = 'on';
        } else {
            room_Dinner = 'off';
        }
        let room_normal_price = jQuery(this).find('.room_normal_price').val();
        let room_endWeek_price = jQuery(this).find('.room_endWeek_price').val();


        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: {
                action: "hhotel_save_rooms",
                'room_number': room_number,
                'pid': pid,
                'room_name': room_name,
                'bed_count': bed_count,
                'room_breackfast': room_breackfast,
                'room_lunch': room_lunch,
                'room_Dinner': room_Dinner,
                'room_normal_price': room_normal_price,
                'room_endWeek_price': room_endWeek_price,
                'room_Double_bed': room_Double_bed,
                'room_single_bed': room_single_bed,
                'r_short_desc': r_short_desc,
                'urls': gurls,
                'room_tip_number': room_tip_number,
            }, beforeSend: function () {
                jQuery('.hsave_room ').text('در حال ذخیره سازی')
            }, success: function (data) {

                jQuery('.hsave_room ').text('ذخیره');
                jQuery('#alert_box ').css({ 'opacity': 1, 'visibility': 'visible' })
                jQuery('#alert_box ').html('<span class="alert_box_close"><i class="fa fa-close"></i></span><p>تغییرات با موفقیت انجام شد.</p>')

            }

        })
    })

})
// jQuery(document).on('click', '.sans_select_but', function () {
//     let $this = jQuery(this);
//     let parents = $this.parents('.avtou_itm');
//     let data = parents.data('tif');
//     let id = $this.data('id');
//
//     jQuery.ajax({
//         url: ajax_data.aju,
//         type: "POST",
//         data: {
//             action: "set_tour_session",
//             'data': data,
//         },
//         beforeSend: function () {
//
//         },
//         success: function (data) {
//
//             window.location.replace(ajax_data.siteurl + "/tour_reserve?poid=" + id);
//
//
//         }
//
//     })
//
// })
// jQuery(document).on('click', '.csans_req_but', function () {
//     let $this = jQuery(this);
//     let data = $this.data('tif');
//     jQuery.ajax({
//         url: ajax_data.aju,
//         type: "POST",
//         data: {
//             action: "set_tour_session_exclusive",
//             'data': data,
//         },
//         beforeSend: function () {

//         },
//         success: function (data) {

//             window.location.replace(ajax_data.siteurl + "/tour_reserve");


//         }

//     })

// })
jQuery(document).on('click', '.all_sans_but', function () {
    jQuery('.all_sans_box').css({ 'display': 'block' })
})

jQuery(document).on('click', '.asanclo', function () {
    jQuery('.all_sans_box').css({ 'display': 'none' })
})
jQuery(document).ready(function ($) {
    jQuery(document).on('click', '#tour_insert_post_btn', function () {
        let $this = jQuery(this);
        let post_name = jQuery('.host_name_inp').val();
        let post_Content = tinymce.get("add_hot").getContent();
        let tour_place_opt = jQuery("input[name=tour_place_opt]").val();
        let necessary_supplies = jQuery('textarea.necessary_supplies').val();
        let proposal_supplies = jQuery('textarea.proposal_supplies').val();
        let text_before = jQuery("input[name=text_before]").val();
        let tour_price = jQuery("input[name=tour_price]").val();
        let tour_address = jQuery("input[name=tour_address]").val();
        let tour_shutter_price = jQuery("input[name=tour_shutter_price]").val();
        let Physical_challenge = jQuery("select[name=Physical_challenge]").val();
        let age_need = jQuery("select[name=age_need]").val();
        let tour_time = jQuery("select[name=tour_time]").val();
        let map_point_lat = jQuery("input[name=map_point_lat]").val();
        let map_point_lng = jQuery("input[name=map_point_lng]").val();
        let tour_capacity = jQuery("select[name=tour_capacity]").val();
        let od_tools = jQuery("input[name=od_tools]").val();
        let attach_url = jQuery('.attach_url').val();
        let gallery_urls = [];
        let gallery_arrau = jQuery('.img_box_show_gall .up_gall_host_box ');
        let meli_pic = jQuery('.img_meli_show img').attr('src');
        $.each(gallery_arrau, function (index, element) {
            let img_src = $(element).find('img').attr('src')
            gallery_urls.push(img_src)
        })
        let city_terms_ids = [];
        let get_terms_city = jQuery("input[name='tax_input[city][]']");
        get_terms_city.filter(":checked").map(function () {
            city_terms_ids.push(this.value)
        }).get()
        let region_terms_ids = [];
        let get_terms_region = jQuery("input[name='tax_input[region][]']");
        get_terms_region.filter(":checked").map(function () {
            region_terms_ids.push(this.value)
        }).get()
        let tools_terms_ids = [];
        let get_terms_tools = jQuery("input[name='tax_input[tools][]']");
        get_terms_tools.filter(":checked").map(function () {
            tools_terms_ids.push(this.value)
        }).get()
        let category_terms_ids = [];
        let get_terms_category = jQuery("input[name='tax_input[categories][]']");
        get_terms_category.filter(":checked").map(function () {
            category_terms_ids.push(this.value)
        }).get()

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: {
                action: "custom_insert_tour",
                'post_title': post_name,
                'post_content': post_Content,
                'tour_place_opt': tour_place_opt,
                'tour_price': tour_price,
                'tour_address': tour_address,
                'Physical_challenge': Physical_challenge,
                'age_need': age_need,
                'tour_time': tour_time,
                'map_point_lat': map_point_lat,
                'map_point_lng': map_point_lng,
                'attach_url': attach_url,
                'gallery_urls': gallery_urls,
                'city_terms': city_terms_ids,
                'region_terms_ids': region_terms_ids,
                'tools_terms_ids': tools_terms_ids,
                'category_terms_ids': category_terms_ids,
                'meli_pic': meli_pic,
                'necessary_supplies': necessary_supplies,
                'proposal_supplies': proposal_supplies,
                'text_before': text_before,
                'tour_capacity': tour_capacity,
                'tour_shutter_price': tour_shutter_price


            }, beforeSend: function () {
                jQuery('#tour_insert_post_btn').text('در حال ذخیره سازی')
            }, success: function (data) {
                jQuery('#tour_insert_post_btn').text('ذخیره');
                let url = ajax_data.turl + '/my-experiences'
                jQuery(location).attr('href', url);
            }
        })
    })

})
jQuery(document).on('click', '#tour_update_post_btn', function () {
    let $this = jQuery(this);
    let post_name = jQuery('.host_name_inp').val();
    let post_Content = tinymce.get("add_hot").getContent();
    let tour_place_opt = jQuery("input[name=tour_place_opt]").val();
    let postId = jQuery("input[name=hipid]").val();
    let necessary_supplies = jQuery('textarea.necessary_supplies').val();
    let proposal_supplies = jQuery('textarea.proposal_supplies').val();
    let text_before = jQuery("input[name=text_before]").val();
    let tour_price = jQuery("input[name=tour_price]").val();
    let tour_shutter_price = jQuery("input[name=tour_shutter_price]").val();
    let tour_address = jQuery("input[name=tour_address]").val();
    let Physical_challenge = jQuery("select[name=Physical_challenge]").val();
    let age_need = jQuery("select[name=age_need]").val();
    let tour_time = jQuery("select[name=tour_time]").val();
    let tour_capacity = jQuery("select[name=tour_capacity]").val();
    let map_point_lat = jQuery("input[name=map_point_lat]").val();
    let map_point_lng = jQuery("input[name=map_point_lng]").val();
    let od_tools = jQuery("input[name=od_tools]").val();
    let attach_url = jQuery('.attach_url').val();
    let gallery_urls = [];
    let gallery_arrau = jQuery('.img_box_show_gall .up_gall_host_box ');
    let meli_pic = jQuery('.img_meli_show img').attr('src');
    jQuery.each(gallery_arrau, function (index, element) {
        let img_src = jQuery(element).find('img').attr('src')
        gallery_urls.push(img_src)
    })
    let city_terms_ids = [];
    let get_terms_city = jQuery("input[name='tax_input[city][]']");
    get_terms_city.filter(":checked").map(function () {
        city_terms_ids.push(this.value)
    }).get()
    let region_terms_ids = [];
    let get_terms_region = jQuery("input[name='tax_input[region][]']");
    get_terms_region.filter(":checked").map(function () {
        region_terms_ids.push(this.value)
    }).get()
    let tools_terms_ids = [];
    let get_terms_tools = jQuery("input[name='tax_input[tools][]']");
    get_terms_tools.filter(":checked").map(function () {
        tools_terms_ids.push(this.value)
    }).get()
    let category_terms_ids = [];
    let get_terms_category = jQuery("input[name='tax_input[categories][]']");
    get_terms_category.filter(":checked").map(function () {
        category_terms_ids.push(this.value)
    }).get()

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "custom_update_tour",
            'post_title': post_name,
            'post_content': post_Content,
            'tour_place_opt': tour_place_opt,
            'text_before': text_before,
            'tour_price': tour_price,
            'tour_address': tour_address,
            'Physical_challenge': Physical_challenge,
            'age_need': age_need,
            'tour_time': tour_time,
            'map_point_lat': map_point_lat,
            'map_point_lng': map_point_lng,
            'attach_url': attach_url,
            'gallery_urls': gallery_urls,
            'city_terms': city_terms_ids,
            'region_terms_ids': region_terms_ids,
            'tools_terms_ids': tools_terms_ids,
            'category_terms_ids': category_terms_ids,
            'meli_pic': meli_pic,
            'necessary_supplies': necessary_supplies,
            'proposal_supplies': proposal_supplies,
            'postId': postId,
            'tour_capacity': tour_capacity,
            'tour_shutter_price': tour_shutter_price


        }, beforeSend: function () {
            jQuery('#tour_update_post_btn').text('در حال ذخیره سازی')
        }, success: function (data) {
            jQuery('#tour_update_post_btn').text('ذخیره');
            // let url = ajax_data.turl + '/my-experiences'
            // jQuery(location).attr('href', url);
        }
    })
})

jQuery(document).on('click', '.ccal_next', function () {
    let $this = jQuery(this);

    let month = $this.attr('data-cdtj');
    let post_id = $this.attr('data-pid');
    let calender_priod = Number($this.attr('data-priod'));
    let current_priod = jQuery('.ccal_prev').attr('data-priod');
    let next_number = calender_priod + 1;
    let next_date = jQuery('.dpi_inp').attr('data-complete');

    jQuery.ajax({
        url: ajax_data.aju, 
        type: "POST", 
        data: { 
            action: "calender_next_cmonth", 
            'month': month, 
            'pid': post_id, 
            'priod': next_number, 
            'next_date': next_date,
            'check_in': next_date  // Pass check-in date for improved logic
        }, 
        beforeSend: function () {
            // Show loading state
            jQuery('.out_calender').addClass('loading');
        }, 
        success: function (data) {
            jQuery('.out_calender').html(data).removeClass('loading');
            
            // Update the checkout calendar with proper logic
            if (next_date) {
                updateCheckoutCalendar(next_date, jQuery('.out_calender'));
            }
            
            jQuery(document).ready(function () {
                jQuery('.ccal_next').replaceWith('<span class="ccal_next" data-priod="' + next_number + '" data-cdtj="' + month + '" data-pid="' + post_id + '"> &#8250; </span>')
            })
        }
    })
})

jQuery(document).ready(function () {
    jQuery(document).on('click', '.ccal_prev', function () {
        let $this = jQuery(this);
        let cal_next = jQuery('.ccal_next');
        let month = cal_next.attr('data-cdtj');
        let post_id = cal_next.attr('data-pid');
        let current_priod = cal_next.attr('data-priod');
        let next_priod = Number(current_priod) - 1;
        let next_date = jQuery('.dpi_inp').attr('data-complete');

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "calender_prev_cmonth", 'month': month, 'pid': post_id, 'priod': current_priod, 'next_date': next_date }, beforeSend: function () {
            }, success: function (data) {
                // jQuery('.in_calender').html(data);
                jQuery('.out_calender').html(data);
                jQuery(document).ready(function () {
                    jQuery('.ccal_next').replaceWith('<span class="ccal_next" data-priod="' + next_priod + '" data-cdtj="' + month + '" data-pid="' + post_id + '"> &gt; </span>')


                })
            }
        })
    })
    jQuery(document).on('click', '.acombtn', function () {
        let $this = jQuery(this);
        let oid = jQuery('.oiidform').val()
        let Match_the_ad = jQuery('.Match_the_ad > input').val()
        let Services = jQuery('.Services > input').val()
        let res_encounter = jQuery('.res_encounter > input').val()
        let cleaning = jQuery('.cleaning > input').val()
        let price = jQuery('.price > input').val()
        let res_Location = jQuery('.res_Location > input').val()
        let desc = jQuery('#acdes').val()

        jQuery.ajax({
            url: ajax_data.aju, type: "POST", data: { action: "insert_comments", 'oid': oid, 'Match_the_ad': Match_the_ad, 'Services': Services, 'res_encounter': res_encounter, 'cleaning': cleaning, 'price': price, 'desc': desc, 'res_Location': res_Location }, beforeSend: function () {
            }, success: function (data) {

                if (data === 'yes') {
                    jQuery('#alert_box').css({ 'visibility': 'visible', 'opacity': '1' });
                    jQuery('#alert_box').append('<span class="alert_title">نظر شما با موفقیت ثبت شد</span>')
                } else {
                    jQuery('#alert_box').css({ 'visibility': 'visible', 'opacity': '1' });
                    jQuery('#alert_box').append('<span class="alert_title">شما قبلا برای این اقامتگاه نظر خود را ثبت کرده اید</span>')
                }
            }
        })
    })


})

jQuery(document).on('click', '.w_ans_submit ', function () {
    let $this = jQuery(this);
    let comment_id = $this.data('coid');
    let parent = $this.parents('.prb_list_item');
    let comment = parent.find('.w_answer_content').val()
    let inp = $this.data('inp')
    let ids = jQuery('.cup_hid').val();

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "update_comm_answer", 'id': comment_id, 'comment': comment }, beforeSend: function () {
        }, success: function (data) {
            jQuery.ajax({
                url: ajax_data.aju, type: "POST", data: { action: "update_comments_by_attr", 'ids': ids, 'option': 'noAnswer_comment' }, beforeSend: function () {
                }, success: function (data) {
                    let noanswer_count = Number(jQuery('.noAnswer_comment >span').text()) - 1;
                    let answer_count = Number(jQuery('.Answer_comment >span').text()) + 1
                    jQuery('.prb_list_body').html(data)
                    jQuery('.noAnswer_comment > span').text(noanswer_count)
                    jQuery('.answered_comment > span').text(answer_count)
                }
            })
        }
    })

})
jQuery(document).on('click', '.prb_list_header ul li ', function () {
    let $this = jQuery(this);
    let inp = $this.data('inp')
    jQuery('.prb_list_header ul li').removeClass('active');
    $this.addClass('active')
    let ids = jQuery('.cup_hid').val();
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "update_comments_by_attr", 'ids': ids, 'option': inp }, beforeSend: function () {
        }, success: function (data) {
            jQuery('.prb_list_body').html(data)
        }
    })

})

jQuery(document).ready((function () {
    jQuery(".user_tickets_view_bot").click((function () {
        jQuery(".user_tickets_view").fadeToggle()
    }))
}))


jQuery(document).ready((function (e) {
    jQuery("#user_ticket").submit((function (e) {

        e.preventDefault();

        jQuery(".ticket_error ul li").remove()
        var a = jQuery(this), r = a.find('input[name="ticket_subject"]').val(), n = a.find('textarea[name="ticket_desc"]').val(), t = a.find('input[name="parent_tic_uid"]').val();
        if (r === '') {

            jQuery(".ticket_error ul").append('<li><i class="fa fa-times"' + ' aria-hidden="true"></i><span>فیلد' + ' موضوع نمیتواند خالی باشد.</span></li>')
        }
        if (n === '') {
            jQuery(".ticket_error ul").append('<li><i class="fa fa-times"' + ' aria-hidden="true"></i><span>فیلد' + ' متن نمیتواند خالی باشد.</span></li>')
        }

        if (r !== '' && n !== '') {
            file_data = jQuery("#user_ticket  #ticket_upload").prop("files")[0], form_da = new FormData, form_da.append("fileupload", file_data), form_da.append("action", "add_ticket"), form_da.append("tic_sub", r), form_da.append("tick_desc", n), form_da.append("uid", t);
            window.location.origin;

            jQuery.ajax({
                url: ajax_data.aju, type: "POST", contentType: !1, processData: !1, data: form_da, beforeSend: function () {
                    jQuery(".ticket_error ul li").remove()
                    jQuery(".ticket_submit").val("درحال ثبت تیکت ...")
                }, success: function (e) {
                    jQuery(".ticket_submit").val("تیکت شما ثبت شد");
                    window.location.reload()


                },


            })
        }


    }))
}))
jQuery(".answer_to_answer_bot").on("click", (function () {
    jQuery(this).parents(".add_answer_to_admin_answer").find(".admin_answer_form_ans").fadeToggle()
}))
jQuery(".answer_ticket_to_answer_submit").on("click", (function () {
    var e = jQuery(this).parents("#user_answet_ticket"), a = e.parents(".add_answer_to_admin_answer"), r = a.find(".send_user_attach").prop("files")[0], n = e.find(".form_ticket_error"), t = (e.find(".form_ticket_success"), e.find(".naswer_to_answer_tid").val());
    ticket_err_p = n.find("p"), ticket_err_p.remove(), n.fadeOut();
    var i = e.find(".ticket_desc_answer").val(), o = i.length, u = new FormData;
    u.append("us_tick_fileupload", r), u.append("action", "add_ticket_answer_to_answer"), u.append("atid", t), u.append("ticket_desc", i), 0 == o && (n.append('<p class="mr5">فیلد متن نباید خالی باشد.</p>'), n.fadeIn()), 0 != o && jQuery.ajax({
        url: ajax_data.aju, type: "POST", contentType: !1, processData: !1, data: u, beforeSend: function () {
            jQuery(".answer_ticket_to_answer_submit").html("در حال ثبت تیکت ...")
        }, success: function (e) {
            jQuery(".form_ticket_success").fadeIn(), jQuery(".add_new_ticket").fadeOut(3e3), jQuery(".form_ticket_success").fadeOut(3e3), a.hide(), location.reload()
        }
    })
}))
jQuery(document).ready((function () {
    jQuery(".add_ticket_but").click((function () {
        jQuery(".add_new_ticket").fadeToggle()
    }))
}))

jQuery(document).on('click', '.pagi_num', function () {
    let $this = jQuery(this);
    let page_number = $this.data('page');
    let num_in_page = jQuery('.pagenum_hid').val();

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_ajax_paginate_post", 'page_number': page_number, 'num_in_page': num_in_page }, beforeSend: function () {

        }, success: function (f) {

            jQuery('.blog_lp_box').html(f)

        }
    })
})
jQuery(document).on('click', '.last_page_pagination', function () {
    let $this = jQuery(this);
    let priv_number = $this.prev().text()
    let first_number = $this.prevAll(".pagi_num").last().data('page')

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_ajax_next_paginate_post", 'priv_number': priv_number, 'first_number': first_number }, beforeSend: function () {

        }, success: function (f) {
            console.log(f)
            jQuery('.j_pagination').html(f)

        }
    })
})
jQuery(document).on('click', '.last_prev_pagination', function () {

    let $this = jQuery(this);
    let priv_number = $this.next().data('page')
    let first_number = $this.nextAll(".pagi_num").last().data('page')

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "get_ajax_prev_paginate_post", 'priv_number': priv_number, 'first_number': first_number }, beforeSend: function () {

        }, success: function (f) {
            console.log(f)
            jQuery('.j_pagination').html(f)

        }
    })
})
jQuery(document).on('click', '.Receipt_send_btn', function () {

    let $this = jQuery(this);
    let cart_digits = jQuery('.cdigit').val();
    let receipt_image = jQuery('.attach_url').val();
    let oid = jQuery('.dataoi').val();
    let fname = jQuery('.pass_fname').val();
    let lname = jQuery('.pass_lname').val();
    let phone = jQuery('.pass_phone').val();
    let post_type = $this.data('pt');
    let pt = 'residance';
    if (post_type === 'hotel') {
        pt = 'hotel'
    }

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "insert_cart_info_to_table", 'os': '12', 'oid': oid, 'cart_digits': cart_digits, 'receipt_image': receipt_image, 'ptype': pt, 'fname': fname, 'lname': lname, 'phone': phone }, beforeSend: function () {

        }, success: function (f) {

            window.location.replace(ajax_data.siteurl + "/trips/");


        }
    })
})
jQuery(document).on('click', '.btn_accept_cart_request ', function () {

    let $this = jQuery(this);
    let iod = $this.data('oid');
    let pt = 'hotel'
    let post_type = $this.data('pt');

    if (post_type == 'res') {
        pt = 'residance';
    }
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "user_change_order_status", 'oid': iod, 'os': '10', 'pt': pt, 'update_wallet': 'ok'
        },

        beforeSend: function () {
        }, success: function (f) {

            location.reload()
        }

    })

})
jQuery(document).on('click', '.btn_cancel_cart_request ', function () {

    let $this = jQuery(this);
    let iod = $this.data('oid');
    let post_type = $this.data('pt');
    var pt = 'hotel'
    if (post_type == 'res') {
        pt = 'residance';
    }


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "user_change_order_status", 'oid': iod, 'os': '3', 'pt': pt
        },

        beforeSend: function () {
        }, success: function (f) {
            location.reload()
        }

    })

})
jQuery(document).on("click", ".del_is", (function () {
    let $this = jQuery(this);
    let data = $this.parent('.del_room').data('info')

    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "remove_hotels_rooms", data: data }, beforeSend: function () {
        }, success: function (a) {
            console.log(a)
            $this.parents('.rooms_inner').remove()
        }
    })
}))
jQuery(document).on('click', '.room_bolbu a', function (e) {

    e.preventDefault()
    let $this = jQuery(this)


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: { action: "is_user_logged_in" }, beforeSend: function () {


        }, success: function (f) {

            if (f === 'yes') {

                window.location = $this.attr('href');
            } else {
                jQuery('#login_box').css({ 'opacity': '1', 'visibility': 'visible' })
                jQuery('#dark_box').css({ 'display': 'block' })
            }

        }

    })
})

jQuery(document).on('click', '.add_aditionam_icon', function () {

    let $this = jQuery(this);
    let tour_id = $this.data('tid')
    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "get_add_user_tour_exp_template", 'tour_id': tour_id,

        }, beforeSend: function () {

        }, success: function (data) {
            jQuery('.adiitional_add_box').html(data)
            jQuery('.adiitional_add_box').css({ 'visibility': 'visible', 'opacity': '1' })
            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})

jQuery(document).on('click', '.ate_submit', function () {

    let $this = jQuery(this);
    let tour_id = $this.data('tid')
    let parent = $this.parents('.fff')
    let name = parent.find('.add_tour_exp').val()
    let price = parent.find('.add_tour_exp_price').val()
    let base_input = parent.find('.tour_base')
    let base = 0
    if (base_input.prop("checked") == true) {
        base = 1;

    }


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "user_add_tour_variable", 'tour_id': tour_id, 'name': name, 'base': base, 'price': price,

        }, beforeSend: function () {

        }, success: function (data) {
            let result = jQuery.parseJSON(data)
            let check = '';
            if (result.base === '1') {
                check = 'checked'
            }

            jQuery('.adiitional_add_box').css({ 'visibility': 'hidden', 'opacity': '0' })
            jQuery('.adiitional_inline_box').append('<div class="mbt15 adiibt"> <label>نام اقامتگاه :</label><input type="text" name="add_tour_exp" class="add_tour_exp" value="' + result.title + '"><label>قیمت (تومان) :</label><input type="number" name="tour_price" class="add_tour_exp_price" value="' + result.price + '" ><label>پیش فرض :</label><input type="checkbox" name="tour_base" class="tour_base" ' + check + ' ><span class="dashicons dashicons-update aib_update" data-id="' + result.lid + '"></span><span class="dashicons dashicons-trash aib_delete" data-id="' + result.lid + '" ></span>')
            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.aib_update', function () {

    let $this = jQuery(this);
    let id = $this.data('id')
    let parent = $this.parents('.adiibt')
    let name = parent.find('.add_tour_exp').val()
    let price = parent.find('.add_tour_exp_price').val()
    let base_input = parent.find('.tour_base')
    let base = 0
    if (base_input.prop("checked") == true) {
        base = 1;

    }


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "user_update_tour_variable", 'id': id, 'name': name, 'price': price, 'base': base,


        }, beforeSend: function () {

        }, success: function (data) {
            alert('اطلاعات اقامتگاه با موفقیت بروز شد')

            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.aib_delete', function () {

    let $this = jQuery(this);
    let id = $this.data('id')
    let parent = $this.parents('.adiibt')


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "user_remove_tour_variable", 'id': id,


        }, beforeSend: function () {

        }, success: function (data) {
            parent.remove()

            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.veiw_but', function () {

    let $this = jQuery(this);
    let hotel_id = $this.data('hoi')
    let key = $this.data('key')


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "get_room_img", 'hotel_id': hotel_id, 'key': key,


        }, beforeSend: function () {

        }, success: function (data) {
            jQuery('.sw_room_slide').html(data)
            jQuery('.room_slider_box').css({ 'opacity': 1, 'visibility': 'visible' })

            // window.location.replace(ajax_data.siteurl + "/tour_reserve");


        }

    })

})
jQuery(document).on('click', '.cupoint', function () {

    jQuery('.room_slider_box').css({ 'opacity': 0, 'visibility': 'hidden' })


})
jQuery(document).on('click', '.cupoint', function () {

    jQuery('.room_slider_box').css({ 'opacity': 0, 'visibility': 'hidden' })


})
jQuery(document).ready(function ($) {
    $('.upload_button_host').on('click', function (e) {
        e.preventDefault();

        var uploader = $(this).closest('.uploader');
        var fileInput = uploader.find('.file_input')[0].files;
        var formData = new FormData();

        for (var i = 0; i < fileInput.length; i++) {
            formData.append('file[]', fileInput[i]);
        }

        formData.append('action', 'rooms_upload_images_hoster');

        $.ajax({
            url: ajax_data.aju, type: 'POST', data: formData, processData: false, contentType: false, success: function (response) {
                var images = JSON.parse(response);

                displayImages(uploader, images);
            }
        });
    });

    function displayImages(uploader, images) {
        var imageContainer = uploader.find('.imageContainer');


        if (images.length > 0) {
            images.forEach(function (imageUrl) {
                imageContainer.append('<div class="imageC_box"><img src="' + imageUrl + '"></div>');
            });
        } else {
            imageContainer.append('<p>No images uploaded</p>');
        }
    }
});
jQuery(document).ready(function ($) {
    $('.room_gall_close').on('click', function (e) {
        let parent = $(this).parents('.imageC_box');
        let src = parent.find('img').attr('src');

        $.ajax({
            url: ajax_data.aju, type: 'POST', data: {
                image_url: src, action: "hos_delete_rooms_image",
            }, success: function (response) {
                // دریافت پاسخ از سمت سرور و نمایش آن در باکس

                parent.remove()
            }
        });
    });

    // بستن باکس با کلیک روی آن

});

function getQueryParam(param) {
    var urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(param);
}

jQuery(document).on('click', '.del_sans_by', function () {

    let $this = jQuery(this);
    let parents = $this.parents('.sans_item');
    let date_parent = parents.find('.sidate');
    let pa = $this.parent('.sitime')
    let date = date_parent.text().trim()
    let pid = $this.attr('data-pid')
    let time = $this.attr('data-time')


    jQuery.ajax({
        url: ajax_data.aju, type: "POST", data: {
            action: "del_sans_h", 'date': date, 'time': time, 'pid': pid,

        }, beforeSend: function () {

        }, success: function (add) {

            pa.remove()
            if (add === 'zero') {
                date_parent.remove()
            }

        }

    })

})

jQuery(document).ready(function ($) {
    $('#city-search-box').on('input', function () {
        var searchValue = $(this).val().trim(); // مقدار وارد شده در جستجو

        $('#city-list > li').each(function () {
            var parentMatch = false; // برای والدها
            var childMatch = false;  // برای زیرمجموعه‌ها

            var parentText = $(this).children('label').text().trim(); // متن دسته والد

            // بررسی تطبیق والد با مقدار جستجو
            if (parentText.includes(searchValue)) {
                parentMatch = true;
            }

            // بررسی تطبیق زیر دسته‌ها با مقدار جستجو
            $(this).find('.child-term').each(function () {
                var childText = $(this).text().trim();
                if (childText.includes(searchValue)) {
                    childMatch = true;
                    $(this).show(); // نمایش زیر دسته‌های مطابق
                } else {
                    $(this).hide(); // مخفی کردن زیر دسته‌های غیرمطابق
                }
            });

            // نمایش والد و زیر دسته‌ها بر اساس تطبیق
            if (parentMatch || childMatch) {
                $(this).show(); // اگر والد یا یکی از زیر دسته‌ها تطبیق داشته باشد، والد را نمایش می‌دهد
                if (parentMatch) {
                    $(this).find('.child-term').show(); // اگر والد تطبیق داشت، همه زیر دسته‌هایش نمایش داده شوند
                }
            } else {
                $(this).hide(); // اگر هیچ تطبیقی نبود، والد و زیرمجموعه‌هایش مخفی شوند
            }
        });
    });
});

function calcReservePrice(res_id, checkin, checkout, no_people) {
    jQuery(document).ready(function ($) {

        $.ajax({
            url: ajaxurl, // این متغیر باید از PHP تعریف شده باشه
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'calcs_reserve_price',
                checkin: checkin,
                checkout: checkout,
                res_id: res_id,
                no_people: no_people
            }, success: function (response) {
                let result = response.data;


                let each_night = result.count_value;

                jQuery('.res_factor_ap').remove()
                jQuery('.rft_box').remove()
                jQuery('.res_factor_item').remove()
                if (result.sub_add_people_price > 0) {
                    jQuery('.res_factor_add_people').append('<div class="res_factor_ap"></div>')

                    jQuery('.res_factor_ap').append('<span> ' + result.add_people_num + ' نفر مهمان اضافه</span> </span> <span>' + result.sub_add_people_price + ' تومان</span>')

                }
                jQuery.each(each_night, function (index, value) {
                    let sum_each = value * index;
                    jQuery('.each_night').append("<div class='res_factor_item'><div><span>" + value + "</span><span  class='space_2x'>شب</span><span>" + index + "</span><span class='space_5x'>x</span></div><div><span>" + value * index + "</span><span class='space_2x'>تومان</span></div></div>")
                })
                // jQuery('.res_factor').append(' <span className="line90"></span>')
                jQuery('.res_factor_total').append('<div class="rft_box"></div>')
                jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + result.total_price + ' تومان<span/>');
                let checki = jQuery('.dpi_inp').attr('data-complete')
                base_url = ajax_data.turl;
                jQuery('.reserve_submit_box a').attr("href", '' + base_url + '/request?res_id=' + res_id + '&check_in=' + checki + '&checkout=' + checkout + '&pass_num=' + no_people);
            },
            error: function () {
                alert('خطا در ارتباط با سرور.');
            }
        });




    });

}
