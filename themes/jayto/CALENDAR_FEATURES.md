# تقویم رزرو پیشرفته جیتو (Jayto Enhanced Reservation Calendar)

## ویژگی‌های پیاده‌سازی شده ✅

### 🔥 منطق پیشرفته انتخاب تاریخ (مشابه shab.ir)

#### تاریخ ورود (Check-in):
- انتخاب هر تاریخ موجود
- تاریخ‌های گذشته غیرفعال می‌شوند
- پس از انتخاب تاریخ ورود، تقویم خروج خودکار باز می‌شود

#### تاریخ خروج (Check-out):
- **تاریخ‌های قبل از check-in**: کاملاً غیرفعال
- **اولین تاریخ غیرفعال بعد از check-in**: قابل انتخاب برای پایان رزرو (با خط چین نارنجی)
- **تاریخ‌های بعد از اولین غیرفعال**: کاملاً مسدود
- **تاریخ‌های موجود بین check-in و اولین غیرفعال**: قابل انتخاب
- **پشتیبانی کامل از انتخاب در تقویم‌های مختلف ماه‌ها**: ✅

### 🎨 نمایش هوشمند تاریخ‌ها

#### رنگ‌بندی استاندارد:
- **تاریخ‌های موجود**: 🟢 سبز با حاشیه سبز
- **تاریخ‌های رزرو شده**: 🟠 نارنجی 
- **تاریخ‌های غیرفعال**: ⚪ خاکستری با خط خورده
- **جمعه‌ها**: 🔴 قرمز
- **امروز**: 🔵 آبی پررنگ

#### انیمیشن‌ها:
- انیمیشن hover نرم
- انیمیشن انتخاب
- انیمیشن pulse برای تاریخ‌های قابل انتخاب در checkout
- انیمیشن slideIn برای پیام‌ها

### 🧮 محاسبه خودکار قیمت

#### قابلیت‌ها:
- محاسبه بر اساس تعداد شب
- نمایش جزئیات قیمت هر شب
- محاسبه تخفیف‌ها
- قیمت آخر هفته (جمعه‌ها)
- هزینه نفرات اضافی
- نمایش مبلغ کل با جداکننده هزارگان

#### ساختار Response:
```json
{
  "success": true,
  "data": {
    "nights": 3,
    "base_price": 1500000,
    "weekend_extra": 200000,
    "extra_people_cost": 150000,
    "discount": 50000,
    "total_price": 1800000,
    "daily_breakdown": {...}
  }
}
```

### 🖱️ رابط کاربری پیشرفته

#### دکمه‌ها و کنترل‌ها:
- **دکمه پاک کردن انتخاب**: برای تقویم checkout
- **نوار پیمایش ماه**: با انیمیشن
- **tooltip قیمت**: نمایش قیمت هنگام hover
- **پیام‌های خطا و موفقیت**: با انیمیشن

#### Responsive Design:
- **دسکتاپ**: 2 تقویم کنار هم (ماه جاری + ماه بعد)
- **تبلت**: بهینه‌سازی اندازه و فاصله‌ها  
- **موبایل**: تقویم تک با تمام قابلیت‌ها

### 🔧 پیاده‌سازی فنی

#### فایل‌های تغییر یافته:
1. **`plugins/jayto-widget/Calender.php`** - تقویم موبایل ✅
2. **`plugins/jayto-widget/Calender_desktop.php`** - تقویم دسکتاپ (ماه اول) ✅
3. **`plugins/jayto-widget/Calender_desktop2.php`** - تقویم دسکتاپ (ماه دوم) ✅
4. **`themes/jayto/calender2.php`** - تقویم checkout AJAX ✅
5. **`themes/jayto/css/calendar-improvements.css`** - استایل‌های بهبود یافته ✅
6. **`themes/jayto/js/calendar-enhancements.js`** - منطق JavaScript پیشرفته ✅
7. **`themes/jayto/functions.php`** - توابع محاسبه قیمت و AJAX ✅
8. **`plugins/jayto-widget/widgets/submits_reserve_request.php`** - ویجت رزرو ✅

#### ساختار کامل تقویم‌ها:

```php
// موبایل
if (wp_is_mobile()) {
    $calendar = new Calendar();              // Calender.php
    $calendar->set_check_in($session_check_in);
    $calendar->set_reserved_dates($reserved_dates);
    echo $calendar;
}

// دسکتاپ  
else {
    $calendar_desk1 = new Calendar_desktop();     // Calender_desktop.php - ماه جاری
    $calendar_desk2 = new Calendar_desktop2();    // Calender_desktop2.php - ماه بعد
    
    // تنظیم check-in و reserved dates برای هر دو
    $calendar_desk1->set_check_in($session_check_in);
    $calendar_desk2->set_check_in($session_check_in);
    $calendar_desk1->set_reserved_dates($reserved_dates);
    $calendar_desk2->set_reserved_dates($reserved_dates);
    
    echo $calendar_desk1 . $calendar_desk2;
}

// AJAX checkout calendar
$checkout_calendar = new Calender2();  // calender2.php
$checkout_calendar->set_chech_in($check_in_date);
$checkout_calendar->set_reserved_dates($reserved_dates);
```

#### کلاس‌های CSS جدید:
- `.checkout-calendar` / `.checkin-calendar`
- `.checkout-selectable`
- `.first-unavailable-checkout`
- `.after-unavailable-block`
- `.before-checkin`
- `.subtle-pulse` (انیمیشن)

#### تابع‌های JavaScript کلیدی:
- `handleDateSelection()` - مدیریت انتخاب تاریخ پیشرفته
- `updateCalendarStates()` - به‌روزرسانی وضعیت تقویم
- `calculateAndDisplayPrice()` - محاسبه و نمایش قیمت
- `clearCalendarSelection()` - پاک کردن انتخاب‌ها

### 🚀 نحوه استفاده

#### برای توسعه‌دهندگان:
```javascript
// فعال‌سازی تقویم بهبود یافته
initCalendarEnhancements();

// سفارشی‌سازی theme
customizeCalendarTheme({
    primaryColor: '#4299e1',
    secondaryColor: '#48bb78'
});
```

#### برای کاربران:
1. انتخاب تاریخ ورود از تقویم
2. تقویم خروج خودکار باز می‌شود
3. انتخاب تاریخ خروج مناسب
4. مشاهده محاسبه خودکار قیمت
5. تأیید رزرو

### 🎯 منطق کامل shab.ir

#### در حالت Check-in:
- همه تاریخ‌های موجود قابل انتخاب
- تاریخ‌های گذشته و رزرو شده غیرفعال
- پس از انتخاب، تقویم checkout باز می‌شود

#### در حالت Check-out:
- تاریخ‌های قبل از check-in: **غیرفعال**
- تاریخ‌های موجود بعد از check-in: **قابل انتخاب** (سبز پالس)
- اولین تاریخ غیرموجود: **قابل انتخاب برای پایان** (نارنجی خط چین)
- تاریخ‌های بعد از اولین غیرموجود: **کاملاً مسدود**

### 🔒 امنیت

- Nonce verification برای AJAX requests
- Sanitization تمام input ها
- Validation کامل تاریخ‌ها
- خطا handling مناسب
- جلوگیری از انتخاب تاریخ‌های نامعتبر

### 📱 سازگاری

- **مرورگرها**: Chrome, Firefox, Safari, Edge
- **دستگاه‌ها**: دسکتاپ، تبلت، موبایل
- **WordPress**: نسخه 5.0+
- **Elementor**: سازگار کامل
- **PHP**: نسخه 7.4+

### 🎉 تست کامل

#### موارد تست شده:
✅ انتخاب تاریخ ورود در موبایل  
✅ انتخاب تاریخ ورود در دسکتاپ (هر دو تقویم)  
✅ منطق checkout در موبایل  
✅ منطق checkout در دسکتاپ (هر دو تقویم)  
✅ انتخاب در تقویم‌های مختلف ماه‌ها  
✅ محاسبه قیمت خودکار  
✅ نمایش پیام‌های مناسب  
✅ دکمه پاک کردن انتخاب  
✅ انیمیشن‌ها و UI  

---

**✨ نتیجه**: تمام 4 فایل تقویم با منطق پیشرفته shab.ir به‌روزرسانی شدند و کاملاً هماهنگ کار می‌کنند!