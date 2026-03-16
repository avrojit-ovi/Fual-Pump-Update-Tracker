<?php
session_start();
require_once '../config.php';
if (isAdminLoggedIn()) { header('Location: /admin/'); exit; }

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($username && $password) {
        $pdo = getDB();
        $stmt = $pdo->prepare("SELECT * FROM admin_users WHERE username=? AND is_active=1");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['admin_username'] = $user['username'];
            $_SESSION['admin_name'] = $user['full_name'];
            $_SESSION['admin_role'] = $user['role'];
            $_SESSION['last_activity'] = time();
            $pdo->prepare("UPDATE admin_users SET last_login=NOW() WHERE id=?")->execute([$user['id']]);
            header('Location: /admin/');
            exit;
        }
        $error = 'ভুল username বা password!';
    } else {
        $error = 'সব তথ্য পূরণ করুন।';
    }
}
?>
<!DOCTYPE html>
<html lang="bn">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin Login — CTG Fuel Tracker</title>
<style>
*{box-sizing:border-box;margin:0;padding:0}
@keyframes grad{0%{background-position:0% 50%}50%{background-position:100% 50%}100%{background-position:0% 50%}}
body{min-height:100vh;background:linear-gradient(-45deg,#0a0f1e,#0d2137,#0a1f18,#12100e);background-size:400% 400%;animation:grad 12s ease infinite;display:flex;align-items:center;justify-content:center;font-family:'Segoe UI',system-ui,sans-serif}
.card{background:rgba(255,255,255,.06);backdrop-filter:blur(12px);border:1px solid rgba(255,255,255,.12);border-radius:20px;padding:40px 36px;width:100%;max-width:400px;box-shadow:0 20px 60px rgba(0,0,0,.5)}
.logo{text-align:center;margin-bottom:32px}
.logo svg{margin-bottom:12px}
.logo h1{font-size:22px;font-weight:700;color:#fff;letter-spacing:.02em}
.logo h1 span{color:#22c55e}
.logo p{font-size:12px;color:rgba(255,255,255,.4);margin-top:4px}
label{font-size:11px;color:rgba(255,255,255,.5);display:block;margin-bottom:4px}
input{width:100%;padding:11px 14px;border:1px solid rgba(255,255,255,.18);border-radius:10px;background:rgba(255,255,255,.09);color:#fff;font-size:14px;font-family:inherit;margin-bottom:16px;outline:none;transition:border-color .2s}
input:focus{border-color:rgba(34,197,94,.5);background:rgba(255,255,255,.13)}
input::placeholder{color:rgba(255,255,255,.3)}
.btn{width:100%;padding:12px;border-radius:10px;border:none;font-size:14px;font-weight:600;cursor:pointer;color:#fff;background:linear-gradient(-45deg,#064e3b,#065f46,#0f766e,#166534);background-size:300% 300%;animation:grad 4s ease infinite;letter-spacing:.02em}
.btn:hover{opacity:.9}
.error{background:rgba(239,68,68,.15);border:1px solid rgba(239,68,68,.35);border-radius:8px;padding:10px 14px;font-size:13px;color:#fca5a5;margin-bottom:16px;text-align:center}
.back{text-align:center;margin-top:20px}
.back a{color:rgba(255,255,255,.4);font-size:12px;text-decoration:none}
.back a:hover{color:#22c55e}
.credit{text-align:center;margin-top:16px;font-size:10px;color:rgba(255,255,255,.2)}
.credit a{color:rgba(255,255,255,.3);text-decoration:none}
</style>
</head>
<body>
<div class="card">
  <div class="logo">
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="1.8"><path d="M3 22V9l9-7 9 7v13"/><path d="M14 22v-7H10v7"/><path d="M9 9h6v5H9z"/></svg>
    <h1>CTG <span>Fuel</span> Tracker</h1>
    <p>Admin Dashboard Login</p>
  </div>
  <?php if($error): ?><div class="error"><?= sanitize($error) ?></div><?php endif; ?>
  <form method="POST">
    <label>Username</label>
    <input type="text" name="username" placeholder="admin" required autocomplete="username">
    <label>Password</label>
    <input type="password" name="password" placeholder="••••••••" required autocomplete="current-password">
    <button type="submit" class="btn">লগইন করুন →</button>
  </form>
  <div class="back"><a href="/">← মানচিত্রে ফিরে যান</a></div>
  <div class="credit">Developed by <a href="https://www.facebook.com/avrojit.ovi/" target="_blank">Avrojit Chowdhury Ovi</a></div>
</div>
</body>
</html>
