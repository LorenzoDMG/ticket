<?php
try {
    // Connexion à la base
    $db = new PDO('mysql:host=localhost;dbname=e-ticket;charset=utf8mb4', 'root', 'root'); // Remplacez 'root' et 'root' par vos identifiants
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>