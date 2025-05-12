<?php
session_start();
require_once 'header.php';
require_once '../php/dbconn.php';
?>
<?php

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}


// Récupération des informations utilisateur
$user_id = $_SESSION['id'];
$stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "Utilisateur non trouvé.";
    exit();
}

// Directly use the values from the $user array
$username = htmlspecialchars($user['username']);
$email = htmlspecialchars($user['email']);
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
            <h1 class="text-2xl font-bold text-center mb-4">Profil de <?php echo $username; ?></h1>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Nom d'utilisateur :</label>
                <p class="text-gray-900"><?php echo $username; ?></p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email :</label>
                <p class="text-gray-900"><?php echo $email; ?></p>
            </div>
            <div class="text-center">
                <a href="logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Déconnexion</a>
            </div>
        </div>
    </div>
</body>
</html>