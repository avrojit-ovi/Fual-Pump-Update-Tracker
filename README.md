# CTG Fuel Tracker
**Developed by:** Avrojit Chowdhury Ovi  
**Facebook:** https://www.facebook.com/avrojit.ovi/

---

## ইনস্টলেশন গাইড (Installation Guide)

### ধাপ ১ — ফাইল আপলোড
সব ফাইল আপনার hosting-এর `public_html` ফোল্ডারে আপলোড করুন।

### ধাপ ২ — Database Config
`config.php` ফাইলে আপনার database তথ্য দিন:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'u594474618_fuelupdate');   // আপনার DB নাম
define('DB_USER', 'u594474618_fuelupdate');   // আপনার username
define('DB_PASS', 'Fuelupdate@108%');          // আপনার password
```

### ধাপ ৩ — Database Setup
Browser-এ যান: `https://yoursite.com/install.php`  
এটি সব table তৈরি করবে এবং sample data insert করবে।

### ধাপ ৪ — Install ফাইল মুছুন ⚠️
`install.php` ফাইলটি **অবশ্যই মুছে ফেলুন** নিরাপত্তার জন্য!

### ধাপ ৫ — Admin Login
`https://yoursite.com/admin/` এ যান।  
**Default credentials:**
- Username: `admin`
- Password: `Admin@CTG2025`

⚠️ প্রথম লগইনের পরেই পাসওয়ার্ড পরিবর্তন করুন!

---

## ফিচার তালিকা

### Public (সবার জন্য)
- ✅ Map-এ সব fuel pump দেখা
- ✅ প্রতিটি pump-এ তেলের অবস্থা ও দাম দেখা
- ✅ তেলের দামের সাজেশন দেওয়া (Admin approval লাগবে)
- ✅ যেকোনো pump-এ রিপোর্ট করা
- ✅ নতুন pump যোগ করা (GPS location দিয়ে)
- ✅ সিরিয়াল অবস্থা রিপোর্ট করা

### Admin Dashboard
- ✅ Dashboard stats (মোট পাম্প, তেল আছে/নেই, আজকের রিপোর্ট)
- ✅ দামের সাজেশন approve/reject করা
- ✅ Pump যোগ/সম্পাদনা/মুছে ফেলা
- ✅ ব্যবহারকারী রিপোর্ট দেখা
- ✅ Admin user যোগ করা ও ম্যানেজ করা

---

## ফাইল স্ট্রাকচার
```
/
├── index.php          ← মূল map পেজ
├── config.php         ← Database config
├── install.php        ← একবার চালান, তারপর মুছুন!
├── .htaccess          ← Security rules
├── api/
│   ├── stations.php   ← Stations API (GET)
│   ├── add_station.php← Station যোগ করার API
│   ├── report.php     ← Report submit API
│   └── suggest_price.php← Price suggestion API
└── admin/
    ├── login.php      ← Admin login
    ├── logout.php     ← Logout
    ├── index.php      ← Dashboard
    ├── stations.php   ← Pump management
    ├── approve.php    ← Price approval
    ├── reports.php    ← User reports
    ├── users.php      ← Admin user management
    └── _header.php    ← Common sidebar/header
```

---

## Tech Stack
- **Backend:** PHP 8+ with PDO
- **Database:** MySQL 5.7+
- **Map:** Leaflet.js + CartoDB tiles
- **Frontend:** Vanilla HTML/CSS/JS (no framework needed)

---

*CTG Fuel Tracker v1.0 — চট্টগ্রামের মানুষের জন্য তৈরি*
