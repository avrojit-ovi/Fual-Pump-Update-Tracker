<?php
session_start();
require_once '../config.php';
requireAdmin();
$page_title = 'Admin ব্যবহারকারী';
$pdo = getDB();
$msg='';$err='';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $action=$_POST['action']??'';
    if ($action==='add') {
        $uname=trim($_POST['username']??'');
        $fname=trim($_POST['full_name']??'');
        $pw=$_POST['password']??'';
        $role=in_array($_POST['role']??'',['admin','superadmin'])?$_POST['role']:'admin';
        $email=trim($_POST['email']??'');
        if(!$uname||!$fname||!$pw){$err='সব তথ্য পূরণ করুন।';}
        elseif(strlen($pw)<8){$err='পাসওয়ার্ড কমপক্ষে ৮ অক্ষর হতে হবে।';}
        elseif($pdo->query("SELECT COUNT(*) FROM admin_users WHERE username='".addslashes($uname)."'")->fetchColumn()){$err='এই username ইতিমধ্যে ব্যবহৃত।';}
        else{
            $pdo->prepare("INSERT INTO admin_users(username,password,full_name,email,role) VALUES(?,?,?,?,?)")->execute([$uname,password_hash($pw,PASSWORD_DEFAULT),$fname,$email,$role]);
            $msg='নতুন Admin "'.$uname.'" যোগ করা হয়েছে!';
        }
    } elseif ($action==='toggle') {
        $id=intval($_POST['id']??0);
        if($id&&$id!==$_SESSION['admin_id']){$pdo->prepare("UPDATE admin_users SET is_active=NOT is_active WHERE id=?")->execute([$id]);$msg='অবস্থা পরিবর্তন হয়েছে।';}
    } elseif ($action==='change_password') {
        $id=intval($_POST['id']??0);$pw=$_POST['new_password']??'';
        if(strlen($pw)<8){$err='পাসওয়ার্ড কমপক্ষে ৮ অক্ষর হতে হবে।';}
        else{$pdo->prepare("UPDATE admin_users SET password=? WHERE id=?")->execute([password_hash($pw,PASSWORD_DEFAULT),$id]);$msg='পাসওয়ার্ড পরিবর্তন হয়েছে!';}
    } elseif ($action==='update_role') {
        $id=intval($_POST['id']??0);$role=in_array($_POST['role']??'',['admin','superadmin'])?$_POST['role']:'admin';
        if($id&&$id!==$_SESSION['admin_id']){$pdo->prepare("UPDATE admin_users SET role=? WHERE id=?")->execute([$role,$id]);$msg='Role পরিবর্তন হয়েছে।';}
    } elseif ($action==='delete') {
        $id=intval($_POST['id']??0);
        if($id&&$id!==$_SESSION['admin_id']){$pdo->prepare("DELETE FROM admin_users WHERE id=?")->execute([$id]);$msg='Admin মুছে ফেলা হয়েছে।';}
        else{$err='নিজেকে মুছতে পারবেন না।';}
    }
}

$users=$pdo->query("SELECT *,(SELECT COUNT(*) FROM admin_users) as total FROM admin_users ORDER BY id")->fetchAll();

include '_header.php';
?>
  <div class="topbar">
    <div><h1>Admin ব্যবহারকারী</h1><div class="breadcrumb">Admin অ্যাকাউন্ট ম্যানেজ করুন</div></div>
  </div>
  <div class="content">
    <?php if($msg): ?><div class="alert alert-success">✓ <?=sanitize($msg)?></div><?php endif; ?>
    <?php if($err): ?><div class="alert alert-error">✕ <?=sanitize($err)?></div><?php endif; ?>

    <div style="display:grid;grid-template-columns:360px 1fr;gap:20px;align-items:start">

      <!-- Add Admin Form -->
      <div class="card">
        <div class="card-header"><span class="card-title">+ নতুন Admin যোগ করুন</span></div>
        <div style="padding:20px">
          <form method="POST">
            <input type="hidden" name="action" value="add">
            <div class="form-group">
              <label class="form-label">পূর্ণ নাম *</label>
              <input name="full_name" class="form-control" placeholder="Avrojit Chowdhury" required>
            </div>
            <div class="form-group">
              <label class="form-label">Username *</label>
              <input name="username" class="form-control" placeholder="admin2" required>
            </div>
            <div class="form-group">
              <label class="form-label">Email</label>
              <input name="email" type="email" class="form-control" placeholder="admin@email.com">
            </div>
            <div class="form-group">
              <label class="form-label">Password * <span style="font-size:10px;color:rgba(255,255,255,.35)">(কমপক্ষে ৮ অক্ষর)</span></label>
              <div style="position:relative">
                <input name="password" type="password" id="new-pw" class="form-control" placeholder="••••••••" required>
                <button type="button" onclick="togglePw('new-pw',this)" style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,.4);cursor:pointer;font-size:14px">👁</button>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Role</label>
              <select name="role" class="form-control">
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
              </select>
            </div>
            <button type="submit" class="btn btn-g" style="width:100%;padding:11px;font-size:13px">Admin যোগ করুন →</button>
          </form>
        </div>
      </div>

      <!-- Admin List -->
      <div class="card">
        <div class="card-header"><span class="card-title">বিদ্যমান Admin (<?=count($users)?>)</span></div>
        <div style="padding:0">
          <?php foreach($users as $u): $isMe=$u['id']===$_SESSION['admin_id']; ?>
          <div style="padding:16px 20px;border-bottom:1px solid rgba(255,255,255,.06);display:flex;align-items:flex-start;gap:14px">
            <!-- Avatar -->
            <div style="width:42px;height:42px;border-radius:50%;background:linear-gradient(-45deg,#065f46,#0f766e);display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:700;color:#fff;flex-shrink:0">
              <?=strtoupper(substr($u['full_name'],0,1))?>
            </div>
            <div style="flex:1;min-width:0">
              <div style="display:flex;align-items:center;gap:8px;margin-bottom:4px">
                <span style="font-size:14px;font-weight:600;color:#e2e8f0"><?=sanitize($u['full_name'])?></span>
                <?php if($isMe): ?><span style="font-size:10px;background:rgba(249,115,22,.2);color:#fb923c;padding:2px 7px;border-radius:4px;font-weight:600">আপনি</span><?php endif; ?>
                <span class="badge <?=$u['role']==='superadmin'?'b-p':'b-k'?>"><?=$u['role']?></span>
                <span class="badge <?=$u['is_active']?'b-g':'b-r'?>"><?=$u['is_active']?'সক্রিয়':'নিষ্ক্রিয়'?></span>
              </div>
              <div style="font-size:11px;color:rgba(255,255,255,.4)">
                @<?=sanitize($u['username'])?> 
                <?=$u['email']?' · '.sanitize($u['email']):'?'?>
              </div>
              <?php if($u['last_login']): ?>
              <div style="font-size:10px;color:rgba(255,255,255,.3);margin-top:2px">শেষ লগইন: <?=date('d M Y, h:i A',strtotime($u['last_login']))?></div>
              <?php endif; ?>

              <?php if(!$isMe): ?>
              <div style="display:flex;gap:7px;margin-top:10px;flex-wrap:wrap">
                <!-- Toggle active -->
                <form method="POST" style="display:inline">
                  <input type="hidden" name="action" value="toggle">
                  <input type="hidden" name="id" value="<?=$u['id']?>">
                  <button type="submit" class="btn <?=$u['is_active']?'btn-r':'btn-g'?>" style="padding:5px 12px;font-size:11px"><?=$u['is_active']?'নিষ্ক্রিয় করুন':'সক্রিয় করুন'?></button>
                </form>
                <!-- Change role -->
                <form method="POST" style="display:inline;display:flex;gap:5px">
                  <input type="hidden" name="action" value="update_role">
                  <input type="hidden" name="id" value="<?=$u['id']?>">
                  <select name="role" class="form-control" style="padding:5px 8px;font-size:11px;width:auto">
                    <option value="admin"<?=$u['role']==='admin'?' selected':''?>>admin</option>
                    <option value="superadmin"<?=$u['role']==='superadmin'?' selected':''?>>superadmin</option>
                  </select>
                  <button type="submit" class="btn btn-b" style="padding:5px 10px;font-size:11px">Role</button>
                </form>
                <!-- Change password -->
                <button class="btn btn-b" style="padding:5px 12px;font-size:11px" onclick="togglePwBox(<?=$u['id']?>)">🔑 পাসওয়ার্ড</button>
                <!-- Delete -->
                <form method="POST" style="display:inline" onsubmit="return confirm('এই Admin মুছে ফেলবেন?')">
                  <input type="hidden" name="action" value="delete">
                  <input type="hidden" name="id" value="<?=$u['id']?>">
                  <button type="submit" class="btn btn-r" style="padding:5px 12px;font-size:11px">✕ মুছুন</button>
                </form>
              </div>
              <div id="pw-box-<?=$u['id']?>" style="display:none;margin-top:10px">
                <form method="POST" style="display:flex;gap:7px;align-items:center">
                  <input type="hidden" name="action" value="change_password">
                  <input type="hidden" name="id" value="<?=$u['id']?>">
                  <div style="position:relative;flex:1">
                    <input type="password" name="new_password" id="cpw-<?=$u['id']?>" class="form-control" placeholder="নতুন পাসওয়ার্ড (৮+ অক্ষর)" style="padding-right:36px">
                    <button type="button" onclick="togglePw('cpw-<?=$u['id']?>',this)" style="position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;color:rgba(255,255,255,.4);cursor:pointer">👁</button>
                  </div>
                  <button type="submit" class="btn btn-g" style="padding:9px 14px;font-size:12px;flex-shrink:0">পরিবর্তন</button>
                </form>
              </div>
              <?php else: ?>
              <div style="margin-top:8px">
                <a href="/admin/users.php?change_my_pw=1" class="btn btn-b" style="padding:5px 12px;font-size:11px">🔑 নিজের পাসওয়ার্ড পরিবর্তন</a>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <?php if(isset($_GET['change_my_pw'])): ?>
    <div class="card" style="max-width:400px;margin-top:20px">
      <div class="card-header"><span class="card-title">🔑 নিজের পাসওয়ার্ড পরিবর্তন</span></div>
      <div style="padding:20px">
        <form method="POST">
          <input type="hidden" name="action" value="change_password">
          <input type="hidden" name="id" value="<?=$_SESSION['admin_id']?>">
          <div class="form-group">
            <label class="form-label">নতুন পাসওয়ার্ড *</label>
            <input type="password" name="new_password" class="form-control" placeholder="কমপক্ষে ৮ অক্ষর" required>
          </div>
          <button type="submit" class="btn btn-g" style="width:100%;padding:11px">পাসওয়ার্ড পরিবর্তন করুন</button>
        </form>
      </div>
    </div>
    <?php endif; ?>
  </div>
  <div class="credit-bar">CTG Fuel Tracker v1.0 &mdash; Developed by <a href="https://www.facebook.com/avrojit.ovi/" target="_blank">Avrojit Chowdhury Ovi</a></div>
<script>
function togglePwBox(id){const b=document.getElementById('pw-box-'+id);b.style.display=b.style.display==='none'?'block':'none';}
function togglePw(inputId,btn){const i=document.getElementById(inputId);i.type=i.type==='password'?'text':'password';btn.textContent=i.type==='password'?'👁':'🙈';}
</script>
</div></body></html>
