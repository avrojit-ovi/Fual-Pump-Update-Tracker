<?php
session_start();
require_once '../config.php';
requireAdmin();
$page_title = 'পাম্প ম্যানেজমেন্ট';
$pdo = getDB();
$msg = ''; $err = '';

// Handle add station
if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['action'])) {
    if ($_POST['action']==='add') {
        $name = trim($_POST['name']??'');
        $addr = trim($_POST['address']??'');
        $lat = floatval($_POST['lat']??0);
        $lng = floatval($_POST['lng']??0);
        $status = $_POST['status']??'unknown';
        $serial = $_POST['serial_status']??'unknown';
        if (!$name||!$lat||!$lng) { $err='সব তথ্য পূরণ করুন।'; }
        else {
            $stmt=$pdo->prepare("INSERT INTO stations (name,address,lat,lng,status,serial_status) VALUES(?,?,?,?,?,?)");
            $stmt->execute([$name,$addr,$lat,$lng,$status,$serial]);
            $sid=$pdo->lastInsertId();
            foreach(['অকটেন','পেট্রোল','ডিজেল'] as $ft) {
                $av=$_POST["fuel_{$ft}"]??'আছে';
                $pr=is_numeric($_POST["price_{$ft}"]??'') ? floatval($_POST["price_{$ft}"]) : null;
                $pdo->prepare("INSERT INTO fuel_data(station_id,fuel_type,availability,price) VALUES(?,?,?,?)")->execute([$sid,$ft,$av,$pr]);
            }
            $msg='পাম্প সফলভাবে যোগ করা হয়েছে!';
        }
    } elseif ($_POST['action']==='update') {
        $id=intval($_POST['id']??0);
        $pdo->prepare("UPDATE stations SET name=?,address=?,status=?,serial_status=?,last_updated=NOW() WHERE id=?")->execute([trim($_POST['name']??''),trim($_POST['address']??''),$_POST['status']??'unknown',$_POST['serial_status']??'unknown',$id]);
        foreach(['অকটেন','পেট্রোল','ডিজেল'] as $ft) {
            $av=$_POST["fuel_{$ft}"]??'আছে';
            $pr=is_numeric($_POST["price_{$ft}"]??'') ? floatval($_POST["price_{$ft}"]) : null;
            $pdo->prepare("INSERT INTO fuel_data(station_id,fuel_type,availability,price) VALUES(?,?,?,?) ON DUPLICATE KEY UPDATE availability=VALUES(availability),price=VALUES(price)")->execute([$id,$ft,$av,$pr]);
        }
        $msg='আপডেট সম্পন্ন!';
    } elseif ($_POST['action']==='delete') {
        $pdo->prepare("UPDATE stations SET is_active=0 WHERE id=?")->execute([intval($_POST['id']??0)]);
        $msg='পাম্প মুছে ফেলা হয়েছে।';
    }
}

$stations=$pdo->query("SELECT s.*,
  (SELECT GROUP_CONCAT(CONCAT(fd.fuel_type,':',COALESCE(fd.price,'—')) SEPARATOR '|') FROM fuel_data fd WHERE fd.station_id=s.id) as fuel_info
  FROM stations s WHERE s.is_active=1 ORDER BY s.name")->fetchAll();

$edit_station=null;
if (isset($_GET['edit'])) {
    $stmt=$pdo->prepare("SELECT s.*,fd.fuel_type,fd.availability,fd.price FROM stations s LEFT JOIN fuel_data fd ON fd.station_id=s.id WHERE s.id=?");
    $stmt->execute([intval($_GET['edit'])]);
    $rows=$stmt->fetchAll();
    if($rows){$edit_station=$rows[0];$edit_station['fuels']=[];foreach($rows as $r){if($r['fuel_type'])$edit_station['fuels'][$r['fuel_type']]=['av'=>$r['availability'],'pr'=>$r['price']];}}
}

include '_header.php';
?>
  <div class="topbar">
    <div><h1>পাম্প ম্যানেজমেন্ট</h1><div class="breadcrumb">সব ফুয়েল পাম্প ম্যানেজ করুন</div></div>
    <a href="?add=1" class="btn btn-g">+ নতুন পাম্প যোগ করুন</a>
  </div>
  <div class="content">
    <?php if($msg): ?><div class="alert alert-success">✓ <?= sanitize($msg) ?></div><?php endif; ?>
    <?php if($err): ?><div class="alert alert-error">✕ <?= sanitize($err) ?></div><?php endif; ?>

    <?php if(isset($_GET['add']) || $edit_station): ?>
    <div class="card" style="margin-bottom:20px">
      <div class="card-header"><span class="card-title"><?= $edit_station?'পাম্প সম্পাদনা করুন':'নতুন পাম্প যোগ করুন' ?></span></div>
      <div style="padding:20px">
      <form method="POST">
        <input type="hidden" name="action" value="<?= $edit_station?'update':'add' ?>">
        <?php if($edit_station): ?><input type="hidden" name="id" value="<?= $edit_station['id'] ?>"><?php endif; ?>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
          <div class="form-group"><label class="form-label">পাম্পের নাম *</label><input name="name" class="form-control" value="<?= sanitize($edit_station['name']??'') ?>" placeholder="মেঘনা পেট্রোলিয়াম" required></div>
          <div class="form-group"><label class="form-label">ঠিকানা</label><input name="address" class="form-control" value="<?= sanitize($edit_station['address']??'') ?>" placeholder="আগ্রাবাদ, চট্টগ্রাম"></div>
          <?php if(!$edit_station): ?>
          <div class="form-group"><label class="form-label">Latitude *</label><input name="lat" type="number" step="0.0000001" class="form-control" placeholder="22.3569" required></div>
          <div class="form-group"><label class="form-label">Longitude *</label><input name="lng" type="number" step="0.0000001" class="form-control" placeholder="91.7832" required></div>
          <?php endif; ?>
          <div class="form-group"><label class="form-label">সার্বিক অবস্থা</label>
            <select name="status" class="form-control">
              <?php foreach(['available'=>'তেল আছে','limited'=>'সীমিত','unavailable'=>'নেই','unknown'=>'অজানা'] as $k=>$v): ?>
              <option value="<?=$k?>"<?=($edit_station['status']??'')===$k?' selected':''?>><?=$v?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group"><label class="form-label">সিরিয়াল অবস্থা</label>
            <select name="serial_status" class="form-control">
              <?php foreach(['none'=>'সিরিয়াল নেই','mid'=>'সিরিয়াল মাঝারি','many'=>'সিরিয়াল বেশি','unknown'=>'অজানা'] as $k=>$v): ?>
              <option value="<?=$k?>"<?=($edit_station['serial_status']??'')===$k?' selected':''?>><?=$v?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div style="margin-top:8px;font-size:12px;font-weight:600;color:rgba(255,255,255,.5);margin-bottom:12px;text-transform:uppercase;letter-spacing:.06em">জ্বালানির তথ্য</div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px">
          <?php foreach(['অকটেন','পেট্রোল','ডিজেল'] as $ft):
            $fav=($edit_station['fuels'][$ft]['av']??'আছে');
            $fpr=($edit_station['fuels'][$ft]['pr']??'');
          ?>
          <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:14px">
            <div style="font-size:13px;font-weight:600;color:#e2e8f0;margin-bottom:10px"><?=$ft?></div>
            <label class="form-label">অবস্থা</label>
            <select name="fuel_<?=$ft?>" class="form-control" style="margin-bottom:8px">
              <?php foreach(['আছে','সীমিত','নেই','প্রযোজ্য নয়'] as $a): ?>
              <option value="<?=$a?>"<?=$fav===$a?' selected':''?>><?=$a?></option>
              <?php endforeach; ?>
            </select>
            <label class="form-label">দাম (৳/লি.)</label>
            <input type="number" name="price_<?=$ft?>" class="form-control" value="<?=$fpr?>" placeholder="যেমন: 130" min="0" step="0.5">
          </div>
          <?php endforeach; ?>
        </div>
        <div style="margin-top:16px;display:flex;gap:10px">
          <button type="submit" class="btn btn-g" style="padding:10px 24px;font-size:13px"><?= $edit_station?'আপডেট করুন':'পাম্প যোগ করুন' ?></button>
          <a href="/admin/stations.php" class="btn btn-b" style="padding:10px 24px;font-size:13px">বাতিল</a>
        </div>
      </form>
      </div>
    </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header"><span class="card-title">সকল পাম্প (<?= count($stations) ?>)</span></div>
      <table>
        <thead><tr><th>#</th><th>নাম</th><th>ঠিকানা</th><th>অবস্থা</th><th>সিরিয়াল</th><th>ধরন</th><th>অ্যাকশন</th></tr></thead>
        <tbody>
        <?php foreach($stations as $s):
          $sb=['available'=>'b-g','limited'=>'b-a','unavailable'=>'b-r'][$s['status']]??'b-k';
          $sl=['available'=>'তেল আছে','limited'=>'সীমিত','unavailable'=>'নেই','unknown'=>'অজানা'][$s['status']]??'অজানা';
          $seri=['none'=>'নেই','mid'=>'মাঝারি','many'=>'বেশি','unknown'=>'অজানা'][$s['serial_status']]??'অজানা';
        ?>
        <tr>
          <td style="color:rgba(255,255,255,.3)"><?=$s['id']?></td>
          <td style="color:#e2e8f0;font-weight:500"><?=sanitize($s['name'])?><?=$s['is_user_submitted']?'<span style="font-size:10px;color:#93c5fd;margin-left:6px">user</span>':''?></td>
          <td style="color:rgba(255,255,255,.5);font-size:12px"><?=sanitize($s['address'])?></td>
          <td><span class="badge <?=$sb?>"><?=$sl?></span></td>
          <td style="font-size:12px;color:rgba(255,255,255,.5)"><?=$seri?></td>
          <td style="font-size:11px;color:rgba(255,255,255,.35)"><?=$s['is_user_submitted']?'ব্যবহারকারী':'Admin'?></td>
          <td>
            <a href="?edit=<?=$s['id']?>" class="btn btn-b" style="padding:5px 10px;font-size:11px">✎ সম্পাদনা</a>
            <form method="POST" style="display:inline" onsubmit="return confirm('এই পাম্পটি মুছে ফেলবেন?')">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?=$s['id']?>">
              <button type="submit" class="btn btn-r" style="padding:5px 10px;font-size:11px">✕ মুছুন</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="credit-bar">CTG Fuel Tracker v1.0 &mdash; Developed by <a href="https://www.facebook.com/avrojit.ovi/" target="_blank">Avrojit Chowdhury Ovi</a></div>
</div></body></html>
