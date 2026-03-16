<?php
session_start();
require_once '../config.php';
requireAdmin();
$page_title = 'ড্যাশবোর্ড';
$pdo = getDB();
$msg='';$err='';

// Quick add admin from dashboard
if ($_SERVER['REQUEST_METHOD']==='POST' && ($_POST['action']??'')==='quick_add_admin') {
    $uname=trim($_POST['username']??'');
    $fname=trim($_POST['full_name']??'');
    $pw=$_POST['password']??'';
    $role=in_array($_POST['role']??'',['admin','superadmin'])?$_POST['role']:'admin';
    if(!$uname||!$fname||!$pw){$err='সব তথ্য পূরণ করুন।';}
    elseif(strlen($pw)<8){$err='পাসওয়ার্ড কমপক্ষে ৮ অক্ষর।';}
    elseif($pdo->query("SELECT COUNT(*) FROM admin_users WHERE username='".addslashes($uname)."'")->fetchColumn()){$err='Username ইতিমধ্যে আছে।';}
    else{
        $pdo->prepare("INSERT INTO admin_users(username,password,full_name,role,is_active) VALUES(?,?,?,?,1)")->execute([$uname,password_hash($pw,PASSWORD_DEFAULT),$fname,$role]);
        $msg='✅ নতুন Admin "'.$fname.'" যোগ করা হয়েছে!';
    }
}

$stats = [
    'total'        => $pdo->query("SELECT COUNT(*) FROM stations WHERE is_active=1")->fetchColumn(),
    'available'    => $pdo->query("SELECT COUNT(*) FROM stations WHERE status='available' AND is_active=1")->fetchColumn(),
    'limited'      => $pdo->query("SELECT COUNT(*) FROM stations WHERE status='limited' AND is_active=1")->fetchColumn(),
    'unavailable'  => $pdo->query("SELECT COUNT(*) FROM stations WHERE status='unavailable' AND is_active=1")->fetchColumn(),
    'pending'      => $pdo->query("SELECT COUNT(*) FROM price_suggestions WHERE status='pending'")->fetchColumn(),
    'reports_today'=> $pdo->query("SELECT COUNT(*) FROM reports WHERE DATE(created_at)=CURDATE()")->fetchColumn(),
    'reports_total'=> $pdo->query("SELECT COUNT(*) FROM reports")->fetchColumn(),
    'user_sub'     => $pdo->query("SELECT COUNT(*) FROM stations WHERE is_user_submitted=1 AND is_active=1")->fetchColumn(),
    'admins'       => $pdo->query("SELECT COUNT(*) FROM admin_users WHERE is_active=1")->fetchColumn(),
];
$recent_reports   = $pdo->query("SELECT r.*,s.name as sn FROM reports r LEFT JOIN stations s ON r.station_id=s.id ORDER BY r.id DESC LIMIT 6")->fetchAll();
$pending_suggests = $pdo->query("SELECT ps.*,s.name as sn FROM price_suggestions ps LEFT JOIN stations s ON ps.station_id=s.id WHERE ps.status='pending' ORDER BY ps.id ASC LIMIT 5")->fetchAll();
$recent_stations  = $pdo->query("SELECT * FROM stations WHERE is_active=1 ORDER BY created_at DESC LIMIT 5")->fetchAll();
$admins_list      = $pdo->query("SELECT id,username,full_name,role,is_active,last_login FROM admin_users ORDER BY id")->fetchAll();

include '_header.php';
?>
  <div class="topbar">
    <div>
      <h1>ড্যাশবোর্ড</h1>
      <div class="breadcrumb">স্বাগতম, <?=sanitize($_SESSION['admin_name']??'')?> &mdash; <?=date('d M Y, h:i A')?></div>
    </div>
    <a href="/" target="_blank" class="btn btn-b" style="padding:8px 16px;font-size:12px">🗺 Live Map</a>
  </div>
  <div class="content">
    <?php if($msg): ?><div class="alert alert-success"><?=sanitize($msg)?></div><?php endif; ?>
    <?php if($err): ?><div class="alert alert-error">✕ <?=sanitize($err)?></div><?php endif; ?>

    <!-- Stats Grid -->
    <div class="stat-grid">
      <div class="stat-card"><div class="label">মোট পাম্প</div><div class="value"><?=$stats['total']?></div><div class="sub">সক্রিয়</div></div>
      <div class="stat-card"><div class="label">তেল আছে</div><div class="value" style="color:#22c55e"><?=$stats['available']?></div><div class="sub">পাম্প</div></div>
      <div class="stat-card"><div class="label">সীমিত</div><div class="value" style="color:#f59e0b"><?=$stats['limited']?></div><div class="sub">পাম্প</div></div>
      <div class="stat-card"><div class="label">তেল নেই</div><div class="value" style="color:#ef4444"><?=$stats['unavailable']?></div><div class="sub">পাম্প</div></div>
      <div class="stat-card"><div class="label">অনুমোদন বাকি</div><div class="value" style="color:#f59e0b"><?=$stats['pending']?></div><div class="sub">দামের সাজেশন</div></div>
      <div class="stat-card"><div class="label">আজকের রিপোর্ট</div><div class="value"><?=$stats['reports_today']?></div><div class="sub">মোট: <?=$stats['reports_total']?></div></div>
      <div class="stat-card"><div class="label">User যোগকৃত</div><div class="value"><?=$stats['user_sub']?></div><div class="sub">পাম্প</div></div>
      <div class="stat-card"><div class="label">সক্রিয় Admin</div><div class="value"><?=$stats['admins']?></div><div class="sub">অ্যাকাউন্ট</div></div>
    </div>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px">
      <!-- Pending Suggestions -->
      <div class="card">
        <div class="card-header"><span class="card-title">⏳ অনুমোদন বাকি দামের সাজেশন</span><a href="/admin/approve.php" class="btn btn-o" style="padding:5px 12px;font-size:11px">সব দেখুন</a></div>
        <?php if($pending_suggests): ?>
        <table>
          <thead><tr><th>পাম্প</th><th>জ্বালানি</th><th>দাম</th><th>অ্যাকশন</th></tr></thead>
          <tbody>
          <?php foreach($pending_suggests as $p): ?>
          <tr>
            <td style="color:#e2e8f0;font-weight:500;font-size:12px"><?=sanitize($p['sn'])?></td>
            <td style="font-size:12px"><?=sanitize($p['fuel_type'])?></td>
            <td><span class="badge b-p">৳<?=number_format($p['suggested_price'],0)?>/লি.</span></td>
            <td>
              <a href="/admin/approve.php?approve=<?=$p['id']?>" class="btn btn-g" style="padding:4px 9px;font-size:11px" onclick="return confirm('অনুমোদন দিবেন?')">✓</a>
              <a href="/admin/approve.php?reject=<?=$p['id']?>" class="btn btn-r" style="padding:4px 9px;font-size:11px" onclick="return confirm('বাতিল করবেন?')">✕</a>
            </td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?><div style="padding:24px;text-align:center;color:rgba(255,255,255,.3);font-size:13px">কোনো অনুমোদন বাকি নেই ✓</div><?php endif; ?>
      </div>

      <!-- Recent Reports -->
      <div class="card">
        <div class="card-header"><span class="card-title">📋 সাম্প্রতিক রিপোর্ট</span><a href="/admin/reports.php" class="btn btn-b" style="padding:5px 12px;font-size:11px">সব দেখুন</a></div>
        <?php if($recent_reports): ?>
        <table>
          <thead><tr><th>পাম্প</th><th>অবস্থা</th><th>সময়</th></tr></thead>
          <tbody>
          <?php foreach($recent_reports as $r):
            $bc=['available'=>'b-g','limited'=>'b-a','unavailable'=>'b-r'][$r['status']]??'b-k';
            $bl=['available'=>'তেল আছে','limited'=>'সীমিত','unavailable'=>'নেই','unknown'=>'অজানা'][$r['status']]??'অজানা';
          ?>
          <tr>
            <td style="color:#e2e8f0;font-weight:500;font-size:12px"><?=sanitize($r['sn'])?></td>
            <td><span class="badge <?=$bc?>"><?=$bl?></span></td>
            <td style="font-size:11px;color:rgba(255,255,255,.4)"><?=date('d M, h:i A',strtotime($r['created_at']))?></td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <?php else: ?><div style="padding:24px;text-align:center;color:rgba(255,255,255,.3);font-size:13px">কোনো রিপোর্ট নেই।</div><?php endif; ?>
      </div>
    </div>

    <!-- ══ NEW ADMIN ADD + ADMIN LIST ══ -->
    <div style="display:grid;grid-template-columns:340px 1fr;gap:20px;align-items:start">

      <!-- Quick Add Admin -->
      <div class="card">
        <div class="card-header">
          <span class="card-title">👤 নতুন Admin যোগ করুন</span>
        </div>
        <div style="padding:20px">
          <form method="POST">
            <input type="hidden" name="action" value="quick_add_admin">
            <div class="form-group">
              <label class="form-label">পূর্ণ নাম *</label>
              <input name="full_name" class="form-control" placeholder="যেমন: Rahim Uddin" required>
            </div>
            <div class="form-group">
              <label class="form-label">Username *</label>
              <input name="username" class="form-control" placeholder="যেমন: rahim_admin" required>
            </div>
            <div class="form-group">
              <label class="form-label">Password * <small style="color:rgba(255,255,255,.3)">(কমপক্ষে ৮ অক্ষর)</small></label>
              <div style="position:relative">
                <input name="password" type="password" id="qpw" class="form-control" placeholder="••••••••" required style="padding-right:42px">
                <button type="button" onclick="const i=document.getElementById('qpw');i.type=i.type==='password'?'text':'password';this.textContent=i.type==='password'?'👁':'🙈'" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,.4);cursor:pointer;font-size:15px">👁</button>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Role</label>
              <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
              </select>
            </div>
            <button type="submit" class="btn btn-g" style="width:100%;padding:12px;font-size:13px;font-weight:600">+ Admin যোগ করুন</button>
          </form>
          <div style="margin-top:14px;padding-top:12px;border-top:1px solid rgba(255,255,255,.08);text-align:center">
            <a href="/admin/users.php" style="color:rgba(255,255,255,.4);font-size:12px;text-decoration:none">সব Admin ম্যানেজ করুন →</a>
          </div>
        </div>
      </div>

      <!-- Admin List -->
      <div class="card">
        <div class="card-header">
          <span class="card-title">🛡 Admin অ্যাকাউন্টসমূহ (<?=count($admins_list)?>)</span>
          <a href="/admin/users.php" class="btn btn-b" style="padding:5px 12px;font-size:11px">বিস্তারিত</a>
        </div>
        <table>
          <thead><tr><th>নাম</th><th>Username</th><th>Role</th><th>অবস্থা</th><th>শেষ লগইন</th></tr></thead>
          <tbody>
          <?php foreach($admins_list as $u): $isMe=$u['id']===$_SESSION['admin_id']; ?>
          <tr>
            <td>
              <div style="display:flex;align-items:center;gap:8px">
                <div style="width:30px;height:30px;border-radius:50%;background:linear-gradient(-45deg,#065f46,#0f766e);display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:#fff;flex-shrink:0"><?=strtoupper(substr($u['full_name'],0,1))?></div>
                <div>
                  <div style="font-size:13px;font-weight:600;color:#e2e8f0"><?=sanitize($u['full_name'])?><?=$isMe?' <span style="font-size:9px;background:rgba(249,115,22,.2);color:#fb923c;padding:1px 6px;border-radius:4px">আপনি</span>':''?></div>
                </div>
              </div>
            </td>
            <td style="font-size:12px;color:rgba(255,255,255,.5)">@<?=sanitize($u['username'])?></td>
            <td><span class="badge <?=$u['role']==='superadmin'?'b-p':'b-k?>'?>"><?=$u['role']?></span></td>
            <td><span class="badge <?=$u['is_active']?'b-g':'b-r'?>"><?=$u['is_active']?'সক্রিয়':'নিষ্ক্রিয়'?></span></td>
            <td style="font-size:10px;color:rgba(255,255,255,.35)"><?=$u['last_login']?date('d M, h:i A',strtotime($u['last_login'])):'কখনো না'?></td>
          </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="credit-bar">CTG Fuel Tracker v1.0 &mdash; Developed by <a href="https://www.facebook.com/avrojit.ovi/" target="_blank">Avrojit Chowdhury Ovi</a></div>
</div>
</body>
</html>
