/**
 * Enhanced Calendar Functionality for Jayto Theme
 * Advanced date selection logic similar to shab.ir
 */

jQuery(document).ready(function($) {
    
    // Global variables for calendar state
    let currentCheckInDate = '';
    let currentCheckOutDate = '';
    let isCheckOutMode = false;
    
    // Add enhanced classes to calendars
    function enhanceCalendars() {
        $('.calendar').each(function() {
            const $calendar = $(this);
            
            // Add improved styling class
            $calendar.addClass('improved-calendar');
            
            // Determine calendar type
            const isCheckoutCalendar = $calendar.hasClass('checkout-calendar');
            
            // Enhanced hover effects for day cells
            $calendar.find('.day_num').hover(
                function() {
                    const $this = $(this);
                    if (isDateSelectable($this)) {
                        $this.addClass('calendar-hover-effect');
                        
                        // Show price tooltip for available dates
                        showPriceTooltip($this);
                    }
                },
                function() {
                    $(this).removeClass('calendar-hover-effect');
                    hidePriceTooltip();
                }
            );
            
            // Enhanced click handling with advanced logic
            $calendar.find('.day_num').off('click.advanced').on('click.advanced', function() {
                const $this = $(this);
                handleDateSelection($this, isCheckoutCalendar);
            });
            
            // Enhance navigation buttons
            $calendar.find('.cal_desk_prev, .cal_desk_next, .ccal_prev, .ccal_next').hover(
                function() {
                    if (!$(this).hasClass('disable')) {
                        $(this).addClass('nav-hover-effect');
                    }
                },
                function() {
                    $(this).removeClass('nav-hover-effect');
                }
            );
        });
    }
    
    // Check if a date is selectable based on advanced logic
    function isDateSelectable($dayCell) {
        // Special case: first unavailable date after check-in can be selected,
        // even if it has 'unavailable' or 'reserved' class. Check this first.
        if ($dayCell.hasClass('first-unavailable-checkout')) {
            return true;
        }

        // General rules for non-selectable dates.
        if ($dayCell.hasClass('ignore') || 
            $dayCell.hasClass('past-date') ||
            $dayCell.hasClass('unavailable') || 
            $dayCell.hasClass('reserved') ||
            $dayCell.hasClass('before-checkin') ||
            $dayCell.hasClass('after-unavailable-block')) {
            return false;
        }
        
        return true;
    }
    
    // Handle advanced date selection logic
    function handleDateSelection($dayCell, isCheckoutCalendar) {
        if (!isDateSelectable($dayCell)) {
            showMessage('این تاریخ قابل انتخاب نیست', 'error');
            return false;
        }
        
        const selectedDate = $dayCell.attr('data-date');
        const selectedDDate = $dayCell.attr('data-ddate');
        
        if (!selectedDate) {
            showMessage('خطا در انتخاب تاریخ', 'error');
            return false;
        }
        
        // Add visual feedback for successful selection
        $dayCell.addClass('selection-success');
        setTimeout(() => {
            $dayCell.removeClass('selection-success');
        }, 300);
        
        if (!isCheckoutCalendar) {
            // Check-in selection
            handleCheckInSelection(selectedDate, selectedDDate, $dayCell);
        } else {
            // Check-out selection
            handleCheckOutSelection(selectedDate, selectedDDate, $dayCell);
        }
        
        // Recalculate prices if both dates are selected
        if (currentCheckInDate && currentCheckOutDate) {
            calculateAndDisplayPrice();
        }
        
        return true;
    }
    
    // Handle check-in date selection
    function handleCheckInSelection(selectedDate, selectedDDate, $dayCell) {
        // Clear previous selections
        $('.calendar .day_num.selected').removeClass('selected');
        
        // Set new selection
        $dayCell.addClass('selected');
        currentCheckInDate = selectedDate;
        
        // Update input field
        $('.dpi_inp').val(selectedDDate).attr('data-complete', selectedDate);
        
        // Clear checkout date if it's before new check-in date
        if (currentCheckOutDate && new Date(currentCheckOutDate) <= new Date(selectedDate)) {
            currentCheckOutDate = '';
            $('.dpo_inp').val('').attr('data-complete', '');
        }
        
        // Show success message
        showMessage('تاریخ ورود انتخاب شد', 'success');
        
        // Auto-open checkout calendar
        setTimeout(() => {
            $('.in_calender').removeClass('active');
            $('.out_calender').addClass('active');
        }, 300);
    }
    
    // Handle check-out date selection
    function handleCheckOutSelection(selectedDate, selectedDDate, $dayCell) {
        if (!currentCheckInDate) {
            showMessage('ابتدا تاریخ ورود را انتخاب کنید', 'error');
            return;
        }
        
        if (new Date(selectedDate) <= new Date(currentCheckInDate)) {
            showMessage('تاریخ خروج باید بعد از تاریخ ورود باشد', 'error');
            return;
        }
        
        // Check for unavailable dates between check-in and check-out
        if (hasUnavailableDatesBetween(currentCheckInDate, selectedDate)) {
            showMessage('در بازه انتخابی تاریخ‌های غیرقابل رزرو وجود دارد', 'error');
            return;
        }
        
        // Clear previous checkout selections
        $('.checkout-calendar .day_num.selected').removeClass('selected');
        
        // Set new selection
        $dayCell.addClass('selected');
        currentCheckOutDate = selectedDate;
        
        // Update input field
        $('.dpo_inp').val(selectedDDate).attr('data-complete', selectedDate);
        
        // Show success message
        showMessage('تاریخ خروج انتخاب شد', 'success');
        
        // Hide calendar after selection
        setTimeout(() => {
            $('.out_calender').removeClass('active');
        }, 500);
    }
    
    // Check for unavailable dates between two dates
    function hasUnavailableDatesBetween(startDate, endDate) {
        const start = new Date(startDate);
        const end = new Date(endDate);
        let current = new Date(start);
        current.setDate(current.getDate() + 1); // Start from day after check-in
        
        while (current < end) {
            const dateStr = current.toISOString().split('T')[0];
            
            // Check if this date exists in any calendar as unavailable or reserved
            const $dateCell = $('.calendar .day_num[data-date="' + dateStr + '"]');
            if ($dateCell.length && ($dateCell.hasClass('unavailable') || $dateCell.hasClass('reserved'))) {
                return true;
            }
            
            current.setDate(current.getDate() + 1);
        }
        
        return false;
    }
    
    // Calculate and display price
    function calculateAndDisplayPrice() {
        if (!currentCheckInDate || !currentCheckOutDate) return;
        
        const checkIn = new Date(currentCheckInDate);
        const checkOut = new Date(currentCheckOutDate);
        const nights = Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24));
        
        if (nights <= 0) return;
        
        // Get residence ID
        const resId = $('#dpin').attr('data-resid') || $('.dpi_inp').closest('[data-resid]').attr('data-resid');
        
        if (resId) {
            // Call price calculation function
            calcReservePrice(resId, currentCheckInDate, currentCheckOutDate, 1);
            
            // Show price breakdown (always refresh to avoid stale cache)
            displayPriceBreakdown(nights);
        }
    }
    
    // Display price breakdown
    function displayPriceBreakdown(nights) {
        const $priceContainer = $('.res_factor .each_night');
        // Clear first to avoid duplication when cached dates persist
        $priceContainer.empty().html(`
            <div class="night-count">
                <span class="nights-label">${nights} شب</span>
                <span class="date-range">${formatDateRange()}</span>
            </div>
        `);
    }

    // Ensure price recalc after initial load and after any ajax calendar load
    function schedulePriceRecalc(){
        setTimeout(()=>{
            const resId = $('#dpin').attr('data-resid') || $('.dpi_inp').closest('[data-resid]').attr('data-resid');
            if (resId && currentCheckInDate && currentCheckOutDate) {
                calculateAndDisplayPrice();
            }
        }, 50);
    }
    
    // Format date range for display
    function formatDateRange() {
        if (!currentCheckInDate || !currentCheckOutDate) return '';
        
        const checkInJalali = convertToJalali(currentCheckInDate);
        const checkOutJalali = convertToJalali(currentCheckOutDate);
        
        return `${checkInJalali} تا ${checkOutJalali}`;
    }
    
    // Convert Gregorian date to Jalali (simplified)
    function convertToJalali(dateStr) {
        // This is a simplified conversion - you might want to use your existing jdate functions
        const date = new Date(dateStr);
        return date.toLocaleDateString('fa-IR');
    }
    
    // Show price tooltip
    function showPriceTooltip($dayCell) {
        const price = $dayCell.find('.event').text();
        if (price && !$dayCell.hasClass('unavailable') && !$dayCell.hasClass('reserved')) {
            const $tooltip = $(`<div class="price-tooltip">${price} تومان</div>`);
            $('body').append($tooltip);
            
            const offset = $dayCell.offset();
            $tooltip.css({
                position: 'absolute',
                top: offset.top - 30,
                left: offset.left + ($dayCell.width() / 2) - ($tooltip.width() / 2),
                background: '#2d3748',
                color: '#fff',
                padding: '4px 8px',
                borderRadius: '4px',
                fontSize: '11px',
                zIndex: 1000,
                pointerEvents: 'none'
            });
        }
    }
    
    // Hide price tooltip
    function hidePriceTooltip() {
        $('.price-tooltip').remove();
    }
    
    // Add clear functionality for checkout calendar
    function addClearButton() {
        $('.checkout-calendar').each(function() {
            if (!$(this).find('.calendar-clear-btn').length) {
                $(this).prepend(`
                    <div class="calendar-clear-btn" title="پاک کردن انتخاب">
                        <span class="clear-icon">×</span>
                    </div>
                `);
            }
        });
    }
    
    // Clear calendar selection
    window.clearCalendarSelection = function() {
        $('.calendar .day_num.selected').removeClass('selected');
        $('.dpi_inp, .dpo_inp').val('').attr('data-complete', '');
        
        // Reset global state
        currentCheckInDate = '';
        currentCheckOutDate = '';
        
        // Clear price display
        $('.res_factor .each_night').html('');
        $('.res_factor_total .rft_box').html('');
        
        // Show success message
        showMessage('تاریخ‌های انتخاب شده پاک شدند', 'success');
        
        // Hide calendar
        $('.in_calender, .out_calender').removeClass('active');
        
    };
    
    // Show messages with animation
    function showMessage(text, type) {
        const messageClass = type === 'success' ? 'date-clear-message' : 'date-selection-error';
        const $message = $(`<div class="${messageClass}">${text}</div>`);
        
        $('.reserve_request_box').prepend($message);
        
        setTimeout(() => {
            $message.fadeOut(300, function() {
                $(this).remove();
            });
        }, 3000);
    }
    
    // Enhanced calendar show/hide animations
    function enhanceCalendarAnimations() {
        $(document).on('click', '.dpi_inp, .ds_box', function() {
            $('.out_calender').removeClass('active');
            $('.in_calender').addClass('active');
            isCheckOutMode = false;
        });
        
        $(document).on('click', '.dpo_inp', function() {
            if (!currentCheckInDate) {
                showMessage('ابتدا تاریخ ورود را انتخاب کنید', 'error');
                return;
            }
            $('.in_calender').removeClass('active');
            $('.out_calender').addClass('active');
            isCheckOutMode = true;
        });
        
        // Close calendar when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.calendar, .ds_box, .dpi_inp, .dpo_inp').length) {
                $('.in_calender, .out_calender').removeClass('active');
            }
        });
    }
    
    // Add loading states for calendar changes
    function addLoadingStates() {
        $(document).on('click', '.cal_desk_prev, .cal_desk_next, .ccal_prev, .ccal_next', function() {
            const $calendar = $(this).closest('.calendar');
            $calendar.addClass('loading');
            
            setTimeout(() => {
                $calendar.removeClass('loading');
                enhanceCalendars();
            }, 500);
        });
    }
    
    // Enhanced date validation
    function validateDateRange() {
        if (currentCheckInDate && currentCheckOutDate) {
            const nights = Math.ceil((new Date(currentCheckOutDate) - new Date(currentCheckInDate)) / (1000 * 60 * 60 * 24));
            
            if (nights > 30) {
                showMessage('حداکثر مدت اقامت 30 شب است', 'error');
                return false;
            }
            
            if (nights < 1) {
                showMessage('حداقل مدت اقامت یک شب است', 'error');
                return false;
            }
        }
        
        return true;
    }
    
    // Improve responsive behavior
    function improveResponsive() {
        function adjustCalendarSize() {
            const screenWidth = $(window).width();
            $('.calendar').each(function() {
                const $calendar = $(this);
                
                if (screenWidth <= 480) {
                    $calendar.addClass('calendar-mobile-small');
                } else if (screenWidth <= 768) {
                    $calendar.addClass('calendar-mobile');
                    $calendar.removeClass('calendar-mobile-small');
                } else {
                    $calendar.removeClass('calendar-mobile calendar-mobile-small');
                }
            });
        }
        
        adjustCalendarSize();
        $(window).on('resize', adjustCalendarSize);
    }
    
    // Add accessibility improvements
    function addAccessibility() {
        $('.calendar .day_num').each(function() {
            const $day = $(this);
            const date = $day.attr('data-date');
            const ddate = $day.attr('data-ddate');
            
            if (date) {
                $day.attr('aria-label', `انتخاب تاریخ ${ddate || date}`);
                $day.attr('role', 'button');
                $day.attr('tabindex', '0');
            }
            
            if (!isDateSelectable($day)) {
                $day.attr('aria-disabled', 'true');
            }
        });
        
        // Keyboard navigation
        $('.calendar .day_num').on('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                $(this).click();
            }
        });
    }
    
    // Initialize session data
    function initializeSessionData() {
        // Check for existing session data
        const sessionCheckIn = $('.dpi_inp').attr('data-complete');
        const sessionCheckOut = $('.dpo_inp').attr('data-complete');
        
        if (sessionCheckIn) {
            currentCheckInDate = sessionCheckIn;
        }
        
        if (sessionCheckOut) {
            currentCheckOutDate = sessionCheckOut;
        }
        
        
        // Calculate price if both dates are available
        schedulePriceRecalc();
    }
    
    // Initialize all enhancements
    function initCalendarEnhancements() {
        enhanceCalendars();
        addClearButton();
        enhanceCalendarAnimations();
        addLoadingStates();
        improveResponsive();
        addAccessibility();
        initializeSessionData();
    }
    
    // Run initial enhancements
    initCalendarEnhancements();
    
    // Re-run enhancements when calendars are dynamically updated
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.addedNodes.length) {
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === 1 && ($(node).hasClass('calendar') || $(node).find('.calendar').length)) {
                        setTimeout(() => {
                            initCalendarEnhancements();
                        }, 100);
                    }
                });
            }
        });
    });
    
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    // Add CSS for dynamic effects
    const dynamicCSS = `
        <style>
        .calendar-hover-effect {
            transform: translateY(-1px) !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        }
        
        .nav-hover-effect {
            transform: scale(1.05) !important;
        }
        
        .selection-success {
            animation: selectionPulse 0.3s ease !important;
        }
        
        @keyframes selectionPulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .calendar-mobile {
            width: 100% !important;
            max-width: 340px !important;
        }
        
        .calendar-mobile-small {
            max-width: 300px !important;
        }
        
        .calendar-mobile .day_num {
            height: 40px !important;
            min-height: 40px !important;
        }
        
        .calendar-mobile-small .day_num {
            height: 36px !important;
            min-height: 36px !important;
        }
        
        .price-tooltip {
            animation: tooltipFadeIn 0.2s ease !important;
        }
        
        @keyframes tooltipFadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .night-count {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 8px 12px !important;
            background: #f8fafc !important;
            border-radius: 8px !important;
            margin-bottom: 8px !important;
        }
        
        .nights-label {
            font-weight: 600 !important;
            color: #2d3748 !important;
        }
        
        .date-range {
            font-size: 12px !important;
            color: #718096 !important;
        }
        </style>
    `;
    
    $('head').append(dynamicCSS);
});

// Add theme color customization support
window.customizeCalendarTheme = function(options = {}) {
    const defaultOptions = {
        primaryColor: '#4299e1',
        secondaryColor: '#48bb78',
        borderRadius: '12px',
        padding: '20px'
    };
    
    const settings = { ...defaultOptions, ...options };
    
    const customCSS = `
        <style id="calendar-custom-theme">
        .calendar {
            border-radius: ${settings.borderRadius} !important;
            padding: ${settings.padding} !important;
        }
        
        .calendar .days .day_num.today {
            background: linear-gradient(135deg, ${settings.primaryColor} 0%, ${adjustColor(settings.primaryColor, -20)} 100%) !important;
            border-color: ${adjustColor(settings.primaryColor, -20)} !important;
        }
        
        .calendar .days .day_num.selected {
            background: linear-gradient(135deg, ${settings.secondaryColor} 0%, ${adjustColor(settings.secondaryColor, -20)} 100%) !important;
            border-color: ${adjustColor(settings.secondaryColor, -20)} !important;
        }
        </style>
    `;
    
    $('#calendar-custom-theme').remove();
    $('head').append(customCSS);
};

// Helper function to adjust color brightness
function adjustColor(color, amount) {
    const usePound = color[0] === '#';
    const col = usePound ? color.slice(1) : color;
    const num = parseInt(col, 16);
    let r = (num >> 16) + amount;
    let b = (num >> 8 & 0x00FF) + amount;
    let g = (num & 0x0000FF) + amount;
    r = r > 255 ? 255 : r < 0 ? 0 : r;
    b = b > 255 ? 255 : b < 0 ? 0 : b;
    g = g > 255 ? 255 : g < 0 ? 0 : g;
    return (usePound ? '#' : '') + (g | (b << 8) | (r << 16)).toString(16);
}

// Enhanced price calculation function
window.calcReservePrice = function(resId, checkIn, checkOut, numPeople) {
    if (!resId || !checkIn || !checkOut) return;
    
    // Enhanced AJAX call with better error handling
    $.ajax({
        url: jayto_ajax.ajax_url,
        type: 'POST',
        data: {
            action: 'calculate_reserve_price',
            res_id: resId,
            check_in: checkIn,
            check_out: checkOut,
            num_people: numPeople,
            nonce: jayto_ajax.nonce
        },
        beforeSend: function() {
            $('.res_factor_total .rft_box').html('<div class="price-loading">محاسبه قیمت...</div>');
        },
        success: function(response) {
            if (response.success) {
                displayPriceResult(response.data);
            } else {
                showMessage('خطا در محاسبه قیمت', 'error');
            }
        },
        error: function() {
            showMessage('خطا در اتصال به سرور', 'error');
        }
    });
};

// Display price calculation result
function displayPriceResult(data) {
    const $priceContainer = $('.res_factor_total .rft_box');
    
    let priceHtml = `
        <div class="price-breakdown">
            <div class="base-price">
                <span>قیمت پایه (${data.nights} شب):</span>
                <span>${formatPrice(data.base_price)} تومان</span>
            </div>
    `;
    
    if (data.weekend_extra) {
        priceHtml += `
            <div class="weekend-price">
                <span>اضافه آخر هفته:</span>
                <span>${formatPrice(data.weekend_extra)} تومان</span>
            </div>
        `;
    }
    
    if (data.discount) {
        priceHtml += `
            <div class="discount-price">
                <span>تخفیف:</span>
                <span class="discount">-${formatPrice(data.discount)} تومان</span>
            </div>
        `;
    }
    
    priceHtml += `
            <div class="total-price">
                <span>مجموع:</span>
                <span class="total">${formatPrice(data.total_price)} تومان</span>
            </div>
        </div>
    `;
    
    $priceContainer.html(priceHtml);
}

// Format price with thousands separator
function formatPrice(price) {
    return parseInt(price).toLocaleString('fa-IR');
}