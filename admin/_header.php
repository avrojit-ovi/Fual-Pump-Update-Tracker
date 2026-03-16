<?php
// Admin header - included in all admin pages
$pending_count = 0;
try {
    $pdo_h = getDB();
    $stmt = $pdo_h->query("SELECT COUNT(*) FROM price_suggestions WHERE status='pending'");
    $pending_count = $stmt->fetchColumn();
} catch(Exception $e) {}
$current_page = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= $page_title ?? 'Dashboard' ?> — CTG Fuel Tracker Admin</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
@keyframes grad{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
body{font-family:'Segoe UI',system-ui,sans-serif;background:#0f1117;color:#e2e8f0;min-height:100vh;display:flex}

/* Sidebar */
#sidebar{width:240px;background:linear-gradient(-45deg,#0a0f1e,#0d2137,#0a1f18,#12100e);background-size:400% 400%;animation:grad 12s ease infinite;border-right:1px solid rgba(255,255,255,.08);display:flex;flex-direction:column;flex-shrink:0;position:fixed;height:100vh;z-index:100}
.sb-logo{padding:24px 20px;border-bottom:1px solid rgba(255,255,255,.08)}
.sb-logo h2{font-size:15px;font-weight:700;color:#fff;display:flex;align-items:center;gap:8px}
.sb-logo h2 span{color:#22c55e}
.sb-logo p{font-size:11px;color:rgba(255,255,255,.35);margin-top:4px}
.sb-nav{flex:1;padding:16px 12px}
.nav-section{font-size:10px;font-weight:600;color:rgba(255,255,255,.3);text-transform:uppercase;letter-spacing:.08em;padding:0 8px;margin:12px 0 6px}
.nav-link{display:flex;align-items:center;gap:10px;padding:9px 12px;border-radius:10px;color:rgba(255,255,255,.6);font-size:13px;text-decoration:none;margin-bottom:2px;transition:all .2s;position:relative}
.nav-link:hover{background:rgba(255,255,255,.08);color:#fff}
.nav-link.active{background:rgba(34,197,94,.15);color:#86efac;border:1px solid rgba(34,197,94,.2)}
.nav-badge{background:#ef4444;color:#fff;font-size:10px;font-weight:700;border-radius:50px;min-width:18px;height:18px;display:inline-flex;align-items:center;justify-content:center;padding:0 4px;margin-left:auto}
.sb-footer{padding:16px;border-top:1px solid rgba(255,255,255,.07)}
.sb-user{display:flex;align-items:center;gap:10px;margin-bottom:12px}
.sb-avatar{width:36px;height:36px;border-radius:50%;background:linear-gradient(-45deg,#065f46,#0f766e);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;color:#fff;flex-shrink:0}
.sb-user-info{flex:1;min-width:0}
.sb-user-name{font-size:13px;font-weight:500;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.sb-user-role{font-size:10px;color:rgba(255,255,255,.4)}
.sb-logout{display:block;text-align:center;padding:8px;background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.2);border-radius:8px;color:#fca5a5;font-size:12px;text-decoration:none;transition:.2s}
.sb-logout:hover{background:rgba(239,68,68,.25)}

/* Main content */
#main{flex:1;margin-left:240px;display:flex;flex-direction:column;min-height:100vh}
.topbar{background:rgba(255,255,255,.03);border-bottom:1px solid rgba(255,255,255,.07);padding:16px 28px;display:flex;align-items:center;justify-content:space-between}
.topbar h1{font-size:18px;font-weight:600;color:#fff}
.topbar .breadcrumb{font-size:12px;color:rgba(255,255,255,.35)}
.content{padding:28px;flex:1}

/* Cards */
.stat-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:16px;margin-bottom:28px}
.stat-card{background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:20px}
.stat-card .label{font-size:11px;color:rgba(255,255,255,.4);font-weight:500;margin-bottom:8px}
.stat-card .value{font-size:28px;font-weight:700;color:#fff}
.stat-card .sub{font-size:11px;color:rgba(255,255,255,.35);margin-top:4px}

/* Table */
.card{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:14px;overflow:hidden;margin-bottom:20px}
.card-header{padding:16px 20px;border-bottom:1px solid rgba(255,255,255,.07);display:flex;align-items:center;justify-content:space-between}
.card-title{font-size:14px;font-weight:600;color:#fff}
table{width:100%;border-collapse:collapse}
th{padding:11px 16px;text-align:left;font-size:11px;font-weight:600;color:rgba(255,255,255,.4);text-transform:uppercase;letter-spacing:.06em;border-bottom:1px solid rgba(255,255,255,.07)}
td{padding:12px 16px;font-size:13px;color:#cbd5e1;border-bottom:1px solid rgba(255,255,255,.04)}
tr:last-child td{border-bottom:none}
tr:hover td{background:rgba(255,255,255,.03)}

/* Badges */
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 10px;border-radius:50px;font-size:11px;font-weight:500;border:1px solid}
.b-g{background:rgba(34,197,94,.18);color:#86efac;border-color:rgba(34,197,94,.35)}
.b-a{background:rgba(245,158,11,.18);color:#fcd34d;border-color:rgba(245,158,11,.35)}
.b-r{background:rgba(239,68,68,.18);color:#fca5a5;border-color:rgba(239,68,68,.35)}
.b-k{background:rgba(156,163,175,.1);color:#d1d5db;border-color:rgba(156,163,175,.2)}
.b-p{background:rgba(245,158,11,.18);color:#fcd34d;border-color:rgba(245,158,11,.35)}

/* Buttons */
.btn{padding:8px 16px;border-radius:8px;border:none;font-size:12px;font-weight:600;cursor:pointer;color:#fff;text-decoration:none;display:inline-flex;align-items:center;gap:6px;transition:opacity .15s}
.btn:hover{opacity:.85}
.btn-g{background:linear-gradient(-45deg,#064e3b,#0f766e);background-size:200% 200%;animation:grad 3s ease infinite}
.btn-r{background:linear-gradient(-45deg,#7f1d1d,#b91c1c);background-size:200% 200%;animation:grad 3s ease infinite}
.btn-b{background:linear-gradient(-45deg,#1e3a5f,#1d4ed8);background-size:200% 200%;animation:grad 3s ease infinite}
.btn-o{background:linear-gradient(-45deg,#78350f,#d97706);background-size:200% 200%;animation:grad 3s ease infinite}

/* Forms */
.form-group{margin-bottom:16px}
.form-label{font-size:12px;color:rgba(255,255,255,.5);display:block;margin-bottom:5px;font-weight:500}
.form-control{width:100%;padding:10px 13px;border:1px solid rgba(255,255,255,.15);border-radius:8px;background:rgba(255,255,255,.07);color:#fff;font-size:13px;font-family:inherit;outline:none;transition:border-color .2s}
.form-control:focus{border-color:rgba(34,197,94,.45);background:rgba(255,255,255,.1)}
.form-control::placeholder{color:rgba(255,255,255,.25)}
select.form-control option{background:#0d2137;color:#fff}

/* Alerts */
.alert{padding:12px 16px;border-radius:10px;font-size:13px;margin-bottom:16px;border:1px solid}
.alert-success{background:rgba(34,197,94,.12);border-color:rgba(34,197,94,.3);color:#86efac}
.alert-error{background:rgba(239,68,68,.12);border-color:rgba(239,68,68,.3);color:#fca5a5}
.alert-info{background:rgba(59,130,246,.12);border-color:rgba(59,130,246,.3);color:#93c5fd}

/* Credit */
.credit-bar{background:rgba(0,0,0,.3);border-top:1px solid rgba(255,255,255,.05);padding:12px 28px;font-size:11px;color:rgba(255,255,255,.25);text-align:center}
.credit-bar a{color:rgba(255,255,255,.35);text-decoration:none}
.credit-bar a:hover{color:#22c55e}

@media(max-width:768px){#sidebar{display:none}#main{margin-left:0}}
</style>
</head>
<body>
<div id="sidebar">
  <div class="sb-logo">
    <h2>
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2"><path d="M3 22V9l9-7 9 7v13"/><path d="M14 22v-7H10v7"/><path d="M9 9h6v5H9z"/></svg>
      CTG <span>Fuel</span> Tracker
    </h2>
    <p>Admin Dashboard</p>
  </div>
  <nav class="sb-nav">
    <div class="nav-section">মূল</div>
    <a href="/admin/" class="nav-link <?= $current_page==='index'?'active':'' ?>">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
      ড্যাশবোর্ড
    </a>
    <a href="/admin/stations.php" class="nav-link <?= $current_page==='stations'?'active':'' ?>">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 22V9l9-7 9 7v13"/></svg>
      পাম্প ম্যানেজমেন্ট
    </a>
    <div class="nav-section">অনুমোদন</div>
    <a href="/admin/approve.php" class="nav-link <?= $current_page==='approve'?'active':'' ?>">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 11l3 3L22 4"/><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"/></svg>
      দামের সাজেশন
      <?php if($pending_count > 0): ?><span class="nav-badge"><?= $pending_count ?></span><?php endif; ?>
    </a>
    <a href="/admin/reports.php" class="nav-link <?= $current_page==='reports'?'active':'' ?>">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14,2 14,8 20,8"/></svg>
      ব্যবহারকারী রিপোর্ট
    </a>
    <?php if(($_SESSION['admin_role']??'')===('superadmin'||'admin')): ?>
    <div class="nav-section">সেটিংস</div>
    <a href="/admin/users.php" class="nav-link <?= $current_page==='users'?'active':'' ?>">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
      Admin ব্যবহারকারী
    </a>
    <?php endif; ?>
    <div class="nav-section">লাইভ</div>
    <a href="/" target="_blank" class="nav-link">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
      Live Map দেখুন
    </a>
  </nav>
  <div class="sb-footer">
    <div class="sb-user">
      <div class="sb-avatar"><?= strtoupper(substr($_SESSION['admin_name']??'A',0,1)) ?></div>
      <div class="sb-user-info">
        <div class="sb-user-name"><?= sanitize($_SESSION['admin_name']??'Admin') ?></div>
        <div class="sb-user-role"><?= sanitize($_SESSION['admin_role']??'admin') ?></div>
      </div>
    </div>
    <a href="/admin/logout.php" class="sb-logout">← লগআউট</a>
  </div>
</div>
<div id="main">
