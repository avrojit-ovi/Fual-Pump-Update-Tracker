<?php
require_once '../config.php';
header('Content-Type: application/json; charset=utf-8');
$pdo = getDB();
$body = json_decode(file_get_contents('php://input'), true);
if (!$body) jsonResponse(['success'=>false,'error'=>'Invalid request']);

$sid = intval($body['station_id'] ?? 0);
if (!$sid) jsonResponse(['success'=>false,'error'=>'Station ID required']);

$allowed = ['available','limited','unavailable','unknown'];
$status = in_array($body['status']??'', $allowed) ? $body['status'] : 'unknown';
$serial = in_array($body['serial_status']??'', ['none','mid','many','unknown']) ? $body['serial_status'] : 'unknown';
$note = substr(trim($body['note']??''), 0, 500);
$ip = $_SERVER['REMOTE_ADDR'] ?? null;

try {
    $stmt = $pdo->prepare("INSERT INTO reports (station_id, status, serial_status, note, reporter_ip) VALUES (?,?,?,?,?)");
    $stmt->execute([$sid, $status, $serial, $note, $ip]);

    // Update station status based on report
    $pdo->prepare("UPDATE stations SET status=?, serial_status=?, last_updated=NOW() WHERE id=?")->execute([$status, $serial, $sid]);

    jsonResponse(['success'=>true]);
} catch(Exception $e) {
    jsonResponse(['success'=>false,'error'=>$e->getMessage()]);
}
