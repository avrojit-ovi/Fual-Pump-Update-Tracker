<?php
require_once '../config.php';
header('Content-Type: application/json; charset=utf-8');
$pdo = getDB();
$body = json_decode(file_get_contents('php://input'), true);
if (!$body) jsonResponse(['success'=>false,'error'=>'Invalid request']);

$sid = intval($body['station_id'] ?? 0);
$fuel = $body['fuel_type'] ?? '';
$price = floatval($body['price'] ?? 0);
$allowed_ft = ['অকটেন','পেট্রোল','ডিজেল'];

if (!$sid) jsonResponse(['success'=>false,'error'=>'Station ID required']);
if (!in_array($fuel, $allowed_ft)) jsonResponse(['success'=>false,'error'=>'Invalid fuel type']);
if ($price <= 0 || $price > 999) jsonResponse(['success'=>false,'error'=>'Invalid price']);

// Check existing pending
$stmt = $pdo->prepare("SELECT id FROM price_suggestions WHERE station_id=? AND fuel_type=? AND status='pending'");
$stmt->execute([$sid, $fuel]);
if ($stmt->fetch()) jsonResponse(['success'=>false,'error'=>'ইতিমধ্যে একটি সাজেশন অনুমোদন বাকি আছে।']);

$ip = $_SERVER['REMOTE_ADDR'] ?? null;
$stmt = $pdo->prepare("INSERT INTO price_suggestions (station_id, fuel_type, suggested_price, reporter_ip) VALUES (?,?,?,?)");
$stmt->execute([$sid, $fuel, $price, $ip]);
jsonResponse(['success'=>true]);
