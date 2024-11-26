<?php $host = 'sql302.infinityfree.com';
$dbname = 'if0_37778253_pokemon_db';
$username = 'if0_37778253';
$password = 'XvBDL8VRIQX68';
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
