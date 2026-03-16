<?php
require_once '../config.php';
header('Content-Type: application/json; charset=utf-8');
$pdo = getDB();
$body = json_decode(file_get_contents('php://input'), true);
if (!$body) jsonResponse(['success'=>false,'error'=>'Invalid request']);

$name = trim($body['name'] ?? '');
if (!$name) jsonResponse(['success'=>false,'error'=>'পাম্পের নাম দিন']);
$lat = floatval($body['lat'] ?? 0);
$lng = floatval($body['lng'] ?? 0);
if (!$lat || !$lng) jsonResponse(['success'=>false,'error'=>'সঠিক অবস্থান দিন']);

$allowed_status = ['available','limited','unavailable','unknown'];
$status = in_array($body['status']??'', $allowed_status) ? $body['status'] : 'unknown';
$serial = in_array($body['serial_status']??'', ['none','mid','many','unknown']) ? $body['serial_status'] : 'unknown';

try {
    $stmt = $pdo->prepare("INSERT INTO stations (name, address, lat, lng, status, serial_status, is_user_submitted) VALUES (?,?,?,?,?,?,?)");
    $stmt->execute([$name, trim($body['address']??''), $lat, $lng, $status, $serial, 1]);
    $sid = $pdo->lastInsertId();

    if (!empty($body['fuels']) && is_array($body['fuels'])) {
        $allowed_av = ['আছে','সীমিত','নেই','প্রযোজ্য নয়'];
        $allowed_ft = ['অকটেন','পেট্রোল','ডিজেল'];
        foreach ($body['fuels'] as $f) {
            if (!in_array($f['fuel_type']??'', $allowed_ft)) continue;
            $av = in_array($f['availability']??'', $allowed_av) ? $f['availability'] : 'আছে';
            $price = is_numeric($f['price']??'') ? floatval($f['price']) : null;
            $stmt = $pdo->prepare("INSERT INTO fuel_data (station_id, fuel_type, availability, price) VALUES (?,?,?,?) ON DUPLICATE KEY UPDATE availability=VALUES(availability), price=VALUES(price)");
            $stmt->execute([$sid, $f['fuel_type'], $av, $price]);
        }
    }
    jsonResponse(['success'=>true,'id'=>$sid]);
} catch(Exception $e) {
    jsonResponse(['success'=>false,'error'=>$e->getMessage()]);
}
