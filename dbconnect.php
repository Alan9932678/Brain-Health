<?php

$server = 'localhost';
$username = 'id14442229_alan99';
$password = 'ChokoPinky#12';
$database = 'id14442229_registros';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
function formatearfecha($fecha){
    return date('g:i a', strtotime($fecha));
}
?>