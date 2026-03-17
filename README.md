# CTG Fuel Tracker

A real-time fuel availability and price tracking system for Chattogram, Bangladesh. Built during the fuel crisis period to help citizens quickly locate fuel pumps with available stock and stay updated on current fuel prices.

---

## 📋 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Tech Stack](#tech-stack)
- [Installation](#installation)
- [Usage](#usage)
- [Project Structure](#project-structure)
- [API Documentation](#api-documentation)
- [Developer](#developer)

---

## 🎯 Overview

**CTG Fuel Tracker** is a community-driven web application designed to address the fuel shortage crisis in Chattogram. The platform provides:

- **Real-time Fuel Availability:** Track which pumps have fuel in stock
- **Price Updates:** Compare fuel prices across different stations
- **Community Reports:** Users can report fuel availability and shortages
- **Map-based Interface:** Interactive map showing all fuel pump locations
- **Admin Dashboard:** Manage pump information and moderate community reports

This application was developed to empower citizens with accurate, up-to-date information during fuel scarcity, reducing waiting time and frustration.

---

## ✨ Key Features

### Public Features (Available to All Users)

- 🗺️ **Interactive Map View** - Display all fuel pumps with their locations
- ⛽ **Fuel Status Check** - See real-time fuel availability at each pump
- 💰 **Price Monitoring** - Track current fuel prices across all stations
- 📝 **Price Suggestions** - Submit price updates (requires admin approval)
- 🚨 **Report Issues** - Report fuel shortages or service problems
- ➕ **Add New Pumps** - Contribute new pump locations with GPS coordinates
- 📢 **Fuel Crisis Alerts** - Report critical fuel shortages in your area

### Admin Dashboard Features

- 📊 **Analytics Dashboard** - View statistics on total pumps, availability, daily reports
- ✅ **Moderate Submissions** - Approve or reject price suggestions
- 🏢 **Pump Management** - Add, edit, or remove fuel pump information
- 📋 **Report Management** - Review and manage user-submitted reports
- 👥 **User Management** - Create and manage admin accounts
- 📈 **Historical Data** - Track fuel availability trends over time

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| **Backend** | PHP 8.0+ with PDO |
| **Database** | MySQL 5.7+ / MariaDB |
| **Frontend Map** | Leaflet.js + CartoDB Tiles |
| **Styling** | Responsive CSS3 |
| **JavaScript** | Vanilla JS (No Framework Required) |
| **Server** | Apache 2.4+ with mod_rewrite |

---

## 📦 Installation Guide

### Prerequisites

- PHP 8.0 or higher
- MySQL 5.7 or higher
- Web hosting with SSH/FTP access
- Domain with SSL certificate (recommended)

### Step 1: Upload Files

Upload all project files to your hosting provider's `public_html` directory using FTP or file manager.

```
public_html/
├── index.php
├── config.php
├── install.php
├── .htaccess
├── api/
├── admin/
└── ... (other files)
```

### Step 2: Configure Database Connection

Edit the `config.php` file with your database credentials:

```php
<?php
// Database Configuration
define('DB_HOST', 'your_db_host');      // Usually 'localhost'
define('DB_NAME', 'your_database_name'); // Database name provided by hosting
define('DB_USER', 'your_db_username');   // Database username
define('DB_PASS', 'your_db_password');   // Database password
define('DB_CHARSET', 'utf8mb4');

// Application Settings
define('SITE_URL', 'https://yourdomain.com');
define('ADMIN_EMAIL', 'admin@yourdomain.com');
?>
```

**⚠️ Keep your database credentials secure. Never commit `config.php` to public repositories.**

### Step 3: Run Installation

1. Visit your domain: `https://yourdomain.com/install.php`
2. The installation script will:
   - Create required database tables
   - Insert sample fuel pump data
   - Set up admin account with temporary credentials
3. Follow the on-screen instructions

### Step 4: Delete Installation File

**⚠️ Security Critical:** After installation completes, delete `install.php` from your server immediately.

```bash
# Via FTP: Delete install.php
# Via SSH: rm public_html/install.php
```

### Step 5: Access Admin Dashboard

Navigate to the admin panel:
- URL: `https://yourdomain.com/admin/`
- You will receive default credentials via email during setup
- **Change your password immediately after first login**

### Step 6: Initial Setup

1. Update your organization details in settings
2. Add or verify fuel pump locations
3. Configure notification settings
4. Create additional admin accounts if needed

---

## 🚀 Usage

### For End Users

1. **View Fuel Pumps:**
   - Visit the home page to see the interactive map
   - Click on any pump marker for detailed information

2. **Check Fuel Availability:**
   - Green marker = Fuel available
   - Red marker = No fuel in stock
   - Yellow marker = Limited stock

3. **Submit Price Update:**
   - Click "Suggest Price" on any pump
   - Enter current price and fuel type
   - Await admin approval (usually within 24 hours)

4. **Report Issues:**
   - Click "Report" on any pump
   - Select issue type (out of stock, closed, etc.)
   - Add optional comments
   - Submit for admin review

5. **Add New Pump:**
   - Click "Add New Pump" button
   - Enter pump details and GPS coordinates
   - Submit for verification

### For Administrators

1. **Login:** Access `yourdomain.com/admin/`
2. **Dashboard:** View real-time statistics and alerts
3. **Manage Pumps:** CRUD operations on fuel stations
4. **Moderate Content:** Approve/reject user submissions
5. **Generate Reports:** Export fuel availability data

---

## 📁 Project Structure

```
CTG-Fuel-Tracker/
│
├── index.php                 # Main public page with map interface
├── config.php               # Database and app configuration
├── install.php              # Installation script (delete after setup)
├── .htaccess                # Apache rewrite rules and security headers
├── robots.txt               # Search engine guidelines
├── sitemap.php              # Dynamic XML sitemap generation
│
├── api/                     # REST API endpoints
│   ├── stations.php         # Get fuel pump listings (GET)
│   ├── add_station.php      # Submit new pump (POST)
│   ├── report.php           # Submit pump report (POST)
│   └── suggest_price.php    # Submit price suggestion (POST)
│
├── admin/                   # Admin dashboard
│   ├── login.php            # Admin authentication
│   ├── logout.php           # Logout endpoint
│   ├── index.php            # Main dashboard with analytics
│   ├── stations.php         # Pump management (Create, Read, Update, Delete)
│   ├── approve.php          # Price submission approval interface
│   ├── reports.php          # View and manage user reports
│   ├── users.php            # Admin user account management
│   └── _header.php          # Common header/sidebar component
│
└── assets/                  # (If applicable)
    ├── css/                 # Stylesheets
    ├── js/                  # JavaScript files
    └── images/              # Images and icons
```

---

## 🔌 API Documentation

### Public API Endpoints

All API responses are in JSON format.

#### Get All Fuel Pumps

```
GET /api/stations.php

Response:
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Pump Name",
      "latitude": 22.3569,
      "longitude": 91.7832,
      "fuel_available": 1,
      "price_regular": 105.50,
      "price_premium": 115.00,
      "updated_at": "2026-03-17 10:30:00"
    }
  ]
}
```

#### Submit New Fuel Pump

```
POST /api/add_station.php

Parameters:
{
  "name": "Pump Name",
  "latitude": 22.3569,
  "longitude": 91.7832,
  "phone": "01700000000"
}

Response:
{
  "success": true,
  "message": "Pump added successfully. Awaiting admin approval."
}
```

#### Submit Pump Report

```
POST /api/report.php

Parameters:
{
  "station_id": 1,
  "report_type": "out_of_stock|closed|price_incorrect|other",
  "description": "Optional details",
  "reporter_phone": "01700000000"
}

Response:
{
  "success": true,
  "message": "Report submitted successfully."
}
```

#### Submit Price Suggestion

```
POST /api/suggest_price.php

Parameters:
{
  "station_id": 1,
  "fuel_type": "regular|premium",
  "price": 105.50,
  "reporter_phone": "01700000000"
}

Response:
{
  "success": true,
  "message": "Price suggestion submitted for review."
}
```

---

## 🔐 Security Considerations

1. **Database Credentials:** Store in environment variables or secure configuration files
2. **Admin Access:** Use strong, unique passwords
3. **Delete Installation File:** Always remove `install.php` after setup
4. **Enable HTTPS:** Use SSL/TLS certificates for all connections
5. **Regular Backups:** Maintain daily database backups
6. **Update Logs:** Monitor admin actions through activity logs
7. **Input Validation:** All user inputs are sanitized server-side

---

## 🐛 Troubleshooting

### White Blank Page
- Check PHP error logs
- Verify database connection in `config.php`
- Ensure all files are uploaded correctly

### Database Connection Error
- Verify credentials in `config.php`
- Check if database server is running
- Confirm database exists and is accessible

### Map Not Loading
- Ensure JavaScript is enabled
- Check browser console for errors
- Verify internet connection for Leaflet.js CDN

### Admin Login Issues
- Clear browser cookies
- Check if `.htaccess` is properly configured
- Verify PHP session support is enabled

---

## 📞 Support & Contribution

For bug reports, feature requests, or contributions:

1. Contact the development team
2. Provide detailed information about the issue
3. Include screenshots or error messages when applicable

---

## 👨‍💻 Developer

**Avrojit Chowdhury Ovi**

- 📘 Facebook: [facebook.com/avrojit.ovi](https://www.facebook.com/avrojit.ovi/)
- 📧 Email: [Available upon request]
- 🌐 Portfolio: [Links coming soon]

---

## 📜 License

This project is developed specifically for the Chattogram community to address fuel availability during crisis situations. Usage and distribution rights are reserved.

---

## 🙏 Acknowledgments

Special thanks to:
- All community members who contributed fuel availability data
- The citizens of Chattogram for supporting this initiative
- All volunteers who tested and provided feedback

---

## 📝 Version History

| Version | Date | Notes |
|---------|------|-------|
| 1.0 | Mar 2026 | Initial release for fuel crisis management |

---

**Last Updated:** March 17, 2026  
**Status:** Active & Maintained

---

*"Empowering the Chattogram community with real-time fuel information"*