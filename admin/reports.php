<?php
session_start();
require_once '../config.php';
requireAdmin();
$page_title = 'ব্যবহারকারী রিপোর্ট';
$pdo = getDB();
$msg='';$err='';

if ($_SERVER['REQUEST_METHOD']==='POST') {
    $action=$_POST['action']??'';
    if ($action==='delete') {
        $id=intval($_POST['id']??0);
        if($id){$pdo->prepare("DELETE FROM reports WHERE id=?")->execute([$id]);$msg='রিপোর্ট মুছে ফেলা হয়েছে।';}
    } elseif ($action==='update') {
        $id=intval($_POST['id']??0);
        $status=$_POST['status']??'unknown';
        $serial=$_POST['serial_status']??'unknown';
        $note=substr(trim($_POST['note']??''),0,500);
        if($id){
            $pdo->prepare("UPDATE reports SET status=?,serial_status=?,note=? WHERE id=?")->execute([$status,$serial,$note,$id]);
            $stmt=$pdo->prepare("SELECT station_id FROM reports WHERE id=?");$stmt->execute([$id]);$row=$stmt->fetch();
            if($row) $pdo->prepare("UPDATE stations SET status=?,serial_status=?,last_updated=NOW() WHERE id=?")->execute([$status,$serial,$row['station_id']]);
            $msg='রিপোর্ট আপডেট হয়েছে।';
        }
    } elseif ($action==='bulk_delete') {
        $ids=array_map('intval',$_POST['ids']??[]);
        if($ids){
            $pl=implode(',',array_fill(0,count($ids),'?'));
            $pdo->prepare("DELETE FROM reports WHERE id IN($pl)")->execute($ids);
            $msg=count($ids).'টি রিপোর্ট মুছে ফেলা হয়েছে।';
        }
    }
}

$page=max(1,intval($_GET['p']??1));$limit=30;$offset=($page-1)*$limit;
$filter_st=$_GET['fs']??'all';$filter_ser=$_GET['fser']??'all';
$where='WHERE 1=1';
if($filter_st!=='all') $where.=" AND r.status='".addslashes($filter_st)."'";
if($filter_ser!=='all') $where.=" AND r.serial_status='".addslashes($filter_ser)."'";
$total=$pdo->query("SELECT COUNT(*) FROM reports r $where")->fetchColumn();
$reports=$pdo->query("SELECT r.*,s.name as station_name FROM reports r LEFT JOIN stations s ON r.station_id=s.id $where ORDER BY r.id DESC LIMIT $limit OFFSET $offset")->fetchAll();
$edit_id=isset($_GET['edit'])?intval($_GET['edit']):null;
$edit_rep=$edit_id?$pdo->query("SELECT * FROM reports WHERE id=$edit_id")->fetch():null;

include '_header.php';
?>
  <div class="topbar">
    <div><h1>ব্যবহারকারী রিপোর্ট</h1><div class="breadcrumb">মোট <?=(int)$total?>টি রিপোর্ট</div></div>
    <div style="display:flex;gap:8px;align-items:center">
      <form method="GET" style="display:flex;gap:6px;align-items:center">
        <select name="fs" class="form-control" style="padding:6px 10px;font-size:12px;width:auto" onchange="this.form.submit()">
          <option value="all"<?=$filter_st==='all'?' selected':''?>>সব অবস্থা</option>
          <option value="available"<?=$filter_st==='available'?' selected':''?>>তেল আছে</option>
          <option value="limited"<?=$filter_st==='limited'?' selected':''?>>সীমিত</option>
          <option value="unavailable"<?=$filter_st==='unavailable'?' selected':''?>>নেই</option>
        </select>
        <select name="fser" class="form-control" style="padding:6px 10px;font-size:12px;width:auto" onchange="this.form.submit()">
          <option value="all"<?=$filter_ser==='all'?' selected':''?>>সব সিরিয়াল</option>
          <option value="none"<?=$filter_ser==='none'?' selected':''?>>লাইন নেই</option>
          <option value="mid"<?=$filter_ser==='mid'?' selected':''?>>অল্প লাইন</option>
          <option value="many"<?=$filter_ser==='many'?' selected':''?>>অনেক লাইন</option>
        </select>
      </form>
    </div>
  </div>
  <div class="content">
    <?php if($msg): ?><div class="alert alert-success">✓ <?=sanitize($msg)?></div><?php endif; ?>

    <?php if($edit_rep): ?>
    <div class="card" style="margin-bottom:20px">
      <div class="card-header"><span class="card-title">✎ রিপোর্ট সম্পাদনা — #<?=$edit_rep['id']?></span></div>
      <div style="padding:20px">
        <form method="POST">
          <input type="hidden" name="action" value="update">
          <input type="hidden" name="id" value="<?=$edit_rep['id']?>">
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px">
            <div><label class="form-label">তেলের অবস্থা</label>
              <select name="status" class="form-control">
                <?php foreach(['available'=>'তেল আছে','limited'=>'সীমিত','unavailable'=>'নেই','unknown'=>'অজানা'] as $k=>$v): ?>
                <option value="<?=$k?>"<?=$edit_rep['status']===$k?' selected':''?>><?=$v?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div><label class="form-label">লাইনের অবস্থা</label>
              <select name="serial_status" class="form-control">
                <?php foreach(['none'=>'লাইন নেই','mid'=>'অল্প লাইন','many'=>'অনেক লাইন','unknown'=>'অজানা'] as $k=>$v): ?>
                <option value="<?=$k?>"<?=$edit_rep['serial_status']===$k?' selected':''?>><?=$v?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
          <div class="form-group"><label class="form-label">মন্তব্য</label>
            <input type="text" name="note" class="form-control" value="<?=sanitize($edit_rep['note']??'')?>">
          </div>
          <div style="display:flex;gap:8px">
            <button type="submit" class="btn btn-g" style="padding:10px 20px">আপডেট করুন</button>
            <a href="/admin/reports.php" class="btn" style="padding:10px 20px;border:1px solid rgba(255,255,255,.15);color:rgba(255,255,255,.6);background:none">বাতিল</a>
          </div>
        </form>
      </div>
    </div>
    <?php endif; ?>

    <div class="card">
      <div class="card-header">
        <span class="card-title">রিপোর্টের তালিকা</span>
        <form method="POST" id="bulk-form">
          <input type="hidden" name="action" value="bulk_delete">
          <button type="button" class="btn btn-r" style="padding:5px 12px;font-size:11px" onclick="bulkDelete()">✕ বাছাইকৃত মুছুন</button>
        </form>
      </div>
      <?php if($reports): ?>
      <table>
        <thead><tr>
          <th><input type="checkbox" id="chk-all" onclick="toggleAll(this)"></th>
          <th>#</th><th>পাম্প</th><th>অবস্থা</th><th>সিরিয়াল</th><th>মন্তব্য</th><th>IP</th><th>সময়</th><th>অ্যাকশন</th>
        </tr></thead>
        <tbody>
        <?php foreach($reports as $r):
          $sb=['available'=>'b-g','limited'=>'b-a','unavailable'=>'b-r'][$r['status']]??'b-k';
          $sl=['available'=>'তেল আছে','limited'=>'সীমিত','unavailable'=>'নেই','unknown'=>'অজানা'][$r['status']]??'অজানা';
          $seri=['none'=>'নেই','mid'=>'অল্প','many'=>'অনেক','unknown'=>'অজানা'][$r['serial_status']]??'অজানা';
        ?>
        <tr>
          <td><input type="checkbox" name="ids[]" value="<?=$r['id']?>" form="bulk-form" class="row-chk"></td>
          <td style="color:rgba(255,255,255,.3)"><?=$r['id']?></td>
          <td style="color:#e2e8f0;font-weight:500;max-width:130px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?=sanitize($r['station_name'])?></td>
          <td><span class="badge <?=$sb?>"><?=$sl?></span></td>
          <td style="font-size:11px;color:rgba(255,255,255,.5)"><?=$seri?></td>
          <td style="font-size:11px;color:rgba(255,255,255,.4);max-width:160px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap"><?=sanitize(mb_substr($r['note']??'—',0,50))?></td>
          <td style="font-size:10px;color:rgba(255,255,255,.3)"><?=htmlspecialchars($r['reporter_ip']??'')?></td>
          <td style="font-size:10px;color:rgba(255,255,255,.4);white-space:nowrap"><?=date('d M, h:i A',strtotime($r['created_at']))?></td>
          <td style="white-space:nowrap">
            <a href="?edit=<?=$r['id']?>" class="btn btn-b" style="padding:4px 10px;font-size:11px">✎</a>
            <form method="POST" style="display:inline" onsubmit="return confirm('মুছে ফেলবেন?')">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="id" value="<?=$r['id']?>">
              <button type="submit" class="btn btn-r" style="padding:4px 10px;font-size:11px">✕</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
      <?php else: ?>
      <div style="padding:40px;text-align:center;color:rgba(255,255,255,.3)">কোনো রিপোর্ট নেই।</div>
      <?php endif; ?>
    </div>

    <?php if(ceil($total/$limit)>1): ?>
    <div style="display:flex;gap:6px;justify-content:center;margin-top:14px;flex-wrap:wrap">
      <?php for($i=1;$i<=ceil($total/$limit);$i++): ?>
      <a href="?p=<?=$i?>&fs=<?=$filter_st?>&fser=<?=$filter_ser?>" class="btn <?=$i===$page?'btn-g':'btn-b'?>" style="padding:6px 12px;font-size:12px"><?=$i?></a>
      <?php endfor; ?>
    </div>
    <?php endif; ?>
  </div>
  <div class="credit-bar">CTG Fuel Tracker v1.0 &mdash; Developed by <a href="https://www.facebook.com/avrojit.ovi/" target="_blank">Avrojit Chowdhury Ovi</a></div>
<script>
function toggleAll(cb){document.querySelectorAll('.row-chk').forEach(c=>c.checked=cb.checked);}
function bulkDelete(){
  const ids=document.querySelectorAll('.row-chk:checked');
  if(!ids.length){alert('কোনো রিপোর্ট বাছাই করা হয়নি।');return;}
  if(!confirm(ids.length+'টি রিপোর্ট মুছে ফেলবেন?'))return;
  document.getElementById('bulk-form').submit();
}
</script>
</div></body></html>
