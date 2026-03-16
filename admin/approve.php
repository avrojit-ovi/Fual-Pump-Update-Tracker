<?php
session_start();
require_once '../config.php';
requireAdmin();
$page_title = 'দামের সাজেশন অনুমোদন';
$pdo = getDB();
$msg='';

if (isset($_GET['approve'])) {
    $id=intval($_GET['approve']);
    $p=$pdo->prepare("SELECT * FROM price_suggestions WHERE id=? AND status='pending'")->execute([$id]);
    $row=$pdo->query("SELECT * FROM price_suggestions WHERE id=$id AND status='pending'")->fetch();
    if($row){
        $pdo->prepare("UPDATE fuel_data SET price=?,updated_at=NOW() WHERE station_id=? AND fuel_type=?")->execute([$row['suggested_price'],$row['station_id'],$row['fuel_type']]);
        $pdo->prepare("UPDATE price_suggestions SET status='approved',reviewed_by=?,reviewed_at=NOW() WHERE id=?")->execute([$_SESSION['admin_id'],$id]);
        $pdo->prepare("UPDATE stations SET last_updated=NOW() WHERE id=?")->execute([$row['station_id']]);
        $msg="✓ {$row['fuel_type']} দাম ৳{$row['suggested_price']} অনুমোদন করা হয়েছে!";
    }
} elseif (isset($_GET['reject'])) {
    $id=intval($_GET['reject']);
    $pdo->prepare("UPDATE price_suggestions SET status='rejected',reviewed_by=?,reviewed_at=NOW() WHERE id=?")->execute([$_SESSION['admin_id'],$id]);
    $msg="সাজেশন বাতিল করা হয়েছে।";
}

$filter=$_GET['filter']??'pending';
$allowed_filter=['pending','approved','rejected','all'];
if(!in_array($filter,$allowed_filter))$filter='pending';
$where=$filter==='all'?'':("WHERE ps.status='".$filter."'");
$suggests=$pdo->query("SELECT ps.*,s.name as station_name FROM price_suggestions ps LEFT JOIN stations s ON ps.station_id=s.id $where ORDER BY ps.id DESC LIMIT 100")->fetchAll();
$counts=['pending'=>$pdo->query("SELECT COUNT(*) FROM price_suggestions WHERE status='pending'")->fetchColumn(),'approved'=>$pdo->query("SELECT COUNT(*) FROM price_suggestions WHERE status='approved'")->fetchColumn(),'rejected'=>$pdo->query("SELECT COUNT(*) FROM price_suggestions WHERE status='rejected'")->fetchColumn()];

include '_header.php';
?>
  <div class="topbar">
    <div><h1>দামের সাজেশন অনুমোদন</h1><div class="breadcrumb">ব্যবহারকারীদের দামের সাজেশন পর্যালোচনা করুন</div></div>
  </div>
  <div class="content">
    <?php if($msg): ?><div class="alert alert-success"><?=sanitize($msg)?></div><?php endif; ?>

    <div style="display:flex;gap:12px;margin-bottom:20px">
      <?php foreach(['pending'=>'⏳ অনুমোদন বাকি','approved'=>'✓ অনুমোদিত','rejected'=>'✕ বাতিল','all'=>'সব দেখুন'] as $k=>$v): ?>
      <a href="?filter=<?=$k?>" class="btn <?=$filter===$k?'btn-g':'btn-b'?>" style="padding:8px 16px">
        <?=$v?> <?php if(isset($counts[$k])): ?><span style="background:rgba(255,255,255,.2);padding:1px 6px;border-radius:10px;font-size:10px"><?=$counts[$k]?></span><?php endif; ?>
      </a>
      <?php endforeach; ?>
    </div>

    <div class="card">
      <div class="card-header"><span class="card-title"><?=count($suggests)?>টি সাজেশন</span></div>
      <?php if($suggests): ?>
      <table>
        <thead><tr><th>#</th><th>পাম্প</th><th>জ্বালানি</th><th>প্রস্তাবিত দাম</th><th>জমার সময়</th><th>অবস্থা</th><th>অ্যাকশন</th></tr></thead>
        <tbody>
        <?php foreach($suggests as $p):
          $sb=['pending'=>'b-a','approved'=>'b-g','rejected'=>'b-r'][$p['status']]??'b-k';
          $sl=['pending'=>'⏳ অনুমোদন বাকি','approved'=>'✓ অনুমোদিত','rejected'=>'✕ বাতিল'][$p['status']]??$p['status'];
        ?>
        <tr>
          <td style="color:rgba(255,255,255,.3)"><?=$p['id']?></td>
          <td style="color:#e2e8f0;font-weight:500"><?=sanitize($p['station_name'])?></td>
          <td><?=sanitize($p['fuel_type'])?></td>
          <td><span class="badge b-p">৳<?=number_format($p['suggested_price'],0)?>/লি.</span></td>
          <td style="font-size:12px;color:rgba(255,255,255,.45)"><?=date('d M Y, h:i A',strtotime($p['created_at']))?></td>
          <td><span class="badge <?=$sb?>"><?=$sl?></span></td>
          <td>
            <?php if($p['status']==='pending'): ?>
            <a href="?approve=<?=$p['id']?>&filter=<?=$filter?>" class="btn btn-g" style="padding:5px 12px;font-size:11px" onclick="return confirm('অনুমোদন দিবেন?')">✓ অনুমোদন</a>
            <a href="?reject=<?=$p['id']?>&filter=<?=$filter?>" class="btn btn-r" style="padding:5px 12px;font-size:11px" onclick="return confirm('বাতিল করবেন?')">✕ বাতিল</a>
            <?php else: ?>
            <span style="font-size:11px;color:rgba(255,255,255,.3)">সম্পন্ন</span>
            <?php endif; ?>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
      <div style="padding:40px;text-align:center;color:rgba(255,255,255,.3);font-size:13px">কোনো সাজেশন নেই।</div>
      <?php endif; ?>
    </div>
  </div>
  <div class="credit-bar">CTG Fuel Tracker v1.0 &mdash; Developed by <a href="https://www.facebook.com/avrojit.ovi/" target="_blank">Avrojit Chowdhury Ovi</a></div>
</div></body></html>
