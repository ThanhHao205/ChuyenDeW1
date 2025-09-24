<?php
session_start();

// Tăng counter
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 1;
} else {
    $_SESSION['counter']++;
}

echo "Session counter: " . $_SESSION['counter'] . "<br>";

// Lấy ID của session hiện tại
$sessionId = session_id();
echo "Session ID: " . $sessionId . "<br>";

// Kết nối Redis
$redis = new Redis();
$redis->connect('redis', 6379); // Nếu dùng Docker: 'redis', nếu cài local: '127.0.0.1'

// Lấy TTL (thời gian sống còn lại) của session
$key = "PHPREDIS_SESSION:" . $sessionId;
$ttl = $redis->ttl($key);

echo "Redis key: " . $key . "<br>";
echo "TTL (giây): " . $ttl . "<br>";
