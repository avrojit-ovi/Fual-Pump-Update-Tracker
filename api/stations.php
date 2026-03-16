<?php
require_once '../config.php';
header('Content-Type: application/json; charset=utf-8');
$pdo = getDB();

$id = isset($_GET['id']) ? intval($_GET['id']) : null;

if ($id) {
    // Single station with full details
    $stmt = $pdo->prepare("SELECT s.*, DATE_FORMAT(s.last_updated,'%d %b %Y, %h:%i %p') as last_updated FROM stations s WHERE s.id = ? AND s.is_active = 1");
    $stmt->execute([$id]);
    $station = $stmt->fetch();
    if (!$station) { jsonResponse(['success'=>false,'error'=>'Not found']); }

    // Fuel data
    $stmt = $pdo->prepare("SELECT fd.*, (SELECT suggested_price FROM price_suggestions ps WHERE ps.station_id=fd.station_id AND ps.fuel_type=fd.fuel_type AND ps.status='pending' ORDER BY ps.created_at DESC LIMIT 1) as pending_price FROM fuel_data fd WHERE fd.station_id = ?");
    $stmt->execute([$id]);
    $station['fuels'] = $stmt->fetchAll();

    // Pending suggests fuel types
    $stmt = $pdo->prepare("SELECT fuel_type FROM price_suggestions WHERE station_id=? AND status='pending'");
    $stmt->execute([$id]);
    $station['pending_suggests'] = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Reports (latest 5)
    $stmt = $pdo->prepare("SELECT *, DATE_FORMAT(created_at,'%d %b %Y, %h:%i %p') as created_at FROM reports WHERE station_id = ? ORDER BY id DESC LIMIT 5");
    $stmt->execute([$id]);
    $station['reports'] = $stmt->fetchAll();

    jsonResponse(['success'=>true,'station'=>$station]);
} else {
    // All stations
    $stmt = $pdo->query("SELECT id, name, address, lat, lng, status, serial_status, is_user_submitted FROM stations WHERE is_active=1 ORDER BY name");
    jsonResponse(['success'=>true,'stations'=>$stmt->fetchAll()]);
}
