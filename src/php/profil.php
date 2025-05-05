<?php
session_start();
require_once 'header.php';
require_once '../php/dbconn.php';
?>
<?php
// profil.php

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données
$host = 'localhost';
$dbname = 'votre_base_de_donnees';
$username = 'votre_utilisateur';
$password = 'votre_mot_de_passe';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Récupération des informations utilisateur
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold text-center mb-4">Profil de <?php echo htmlspecialchars($user['username']); ?></h1>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nom d'utilisateur :</label>
                <p class="text-gray-900"><?php echo htmlspecialchars($user['username']); ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email :</label>
                <p class="text-gray-900"><?php echo htmlspecialchars($user['email']); ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Date de création :</label>
                <p class="text-gray-900"><?php echo htmlspecialchars($user['created_at']); ?></p>
            </div>
            <div class="text-center">
                <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Déconnexion</a>
            </div>
        </div>
    </div>
</body>
</html>