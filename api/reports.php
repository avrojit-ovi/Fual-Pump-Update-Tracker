<?php
require_once '../config.php';
header('Content-Type: application/json; charset=utf-8');
$pdo = getDB();

function timeAgo($datetime) {
    $diff = time() - strtotime($datetime);
    if ($diff < 60) return $diff.'s আগে';
    if ($diff < 3600) return floor($diff/60).' মিনিট আগে';
    if ($diff < 86400) return floor($diff/3600).' ঘণ্টা আগে';
    return floor($diff/86400).' দিন আগে';
}

// Stats
$total = $pdo->query("SELECT COUNT(*) FROM reports")->fetchColumn();
$unique_users = $pdo->query("SELECT COUNT(DISTINCT reporter_ip) FROM reports")->fetchColumn();
$avg_price = $pdo->query("SELECT ROUND(AVG(price),0) FROM fuel_data WHERE fuel_type='অকটেন' AND price IS NOT NULL")->fetchColumn();

// Reports with station name
$stmt = $pdo->query("
    SELECT r.*, s.name as station_name, s.lat, s.lng
    FROM reports r
    LEFT JOIN stations s ON r.station_id = s.id
    WHERE s.is_active = 1
    ORDER BY r.id DESC
    LIMIT 100
");
$reports = $stmt->fetchAll();

$out = [];
foreach ($reports as $r) {
    $out[] = [
        'id' => $r['id'],
        'station_id' => $r['station_id'],
        'station_name' => $r['station_name'],
        'status' => $r['status'],
        'serial_status' => $r['serial_status'],
        'note' => $r['note'],
        'reporter' => 'user_'.(crc32($r['reporter_ip']??'')%1000+100),
        'time_ago' => timeAgo($r['created_at']),
        'created_at' => $r['created_at'],
        'upvotes' => 0,
        'downvotes' => 0,
        'price' => null,
    ];
}

jsonResponse([
    'success' => true,
    'reports' => $out,
    'total' => (int)$total,
    'unique_users' => (int)$unique_users,
    'avg_price' => $avg_price ? (int)$avg_price : null,
]);
