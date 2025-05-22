<?php
require_once 'header.php';
require_once 'dbconn.php'; // Assurez-vous que ce fichier contient la connexion à la base de données

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
}

// Récupération des informations depuis la session
$username = htmlspecialchars($_SESSION['fname'] . ' ' . $_SESSION['lname']);
$user_id = $_SESSION['id'];

// Récupérer le rôle de l'utilisateur depuis la base de données
$query = $db->prepare("SELECT Roles.Name AS role_name FROM Users 
                       JOIN Roles ON Users.Role_id = Roles.Id 
                       WHERE Users.Id = ?");
$query->execute([$user_id]);
$user_role = $query->fetch(PDO::FETCH_ASSOC)['role_name'] ?? 'Utilisateur';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-800 text-gray-300 font-sans relative">

    <!-- Nav -->

    <!-- Main Content -->
    <main class="mt-16 w-7/12 mx-auto px-4 py-12 text-center">
        <div class="bg-gray-700 p-8 rounded-lg shadow-lg">
            <h1 class="text-4xl font-extrabold text-indigo-400 mb-6">Profil de <?php echo $username; ?></h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-left">
                <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <label class="block text-gray-400 font-medium mb-2">Nom complet :</label>
                    <p class="text-gray-200 text-lg font-semibold"><?php echo $username; ?></p>
                </div>
                <div class="bg-gray-800 p-6 rounded-lg shadow-md">
                    <label class="block text-gray-400 font-medium mb-2">Rôle :</label>
                    <p class="text-gray-200 text-lg font-semibold"><?php echo htmlspecialchars($user_role); ?></p>
                </div>
            </div>
            <div class="mt-8">
                <a href="logout.php" class="bg-red-500 text-white px-8 py-3 rounded-lg hover:bg-red-600 shadow-lg transition">
                    Déconnexion
                </a>
            </div>
        </div>
    </main>

    <?php require_once './footer.php'; ?>
</body>
</html>