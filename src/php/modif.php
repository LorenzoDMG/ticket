
<?php
$pdo = new PDO('mysql:host=localhost;dbname=e-ticket;charset=utf8mb4', 'root', 'root'); // adapte selon ton MAMP/XAMPP
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
require_once 'header.php';


// Récupérer l'utilisateur connecté (exemple avec $_SESSION['user_id'])
if (!isset($_SESSION['id'])) {
    header('Location: login.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit;
}
// Vérifier si l'utilisateur existe
// Récupérer les infos actuelles
$stmt = $pdo->prepare("SELECT Username, Firstname, Lastname, mail FROM Users WHERE Id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];

    $update = $pdo->prepare("UPDATE Users SET Username=?, Firstname=?, Lastname=?, mail=? WHERE Id=?");
    $update->execute([$username, $firstname, $lastname, $mail, $user_id]);
    header('Location: edit_profile.php?success=1');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <title>Modifier mon profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center">
    <div class="glass-effect rounded-3xl p-10 w-full max-w-lg shadow-xl">
        <h2 class="text-3xl font-bold text-shimmer mb-8 text-center">Modifier mon profil</h2>
        <?php if (isset($_GET['success'])): ?>
            <div class="mb-4 text-green-500 text-center">Profil mis à jour !</div>
        <?php endif; ?>
        <form method="post" class="space-y-6">
            <div>
                <label class="block text-gray-300 mb-1">Nom d'utilisateur</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['Username']) ?>" class="w-full rounded-lg glass-effect px-4 py-2 text-white focus:outline-none" required>
            </div>
            <div>
                <label class="block text-gray-300 mb-1">Prénom</label>
                <input type="text" name="firstname" value="<?= htmlspecialchars($user['Firstname']) ?>" class="w-full rounded-lg glass-effect px-4 py-2 text-white focus:outline-none" required>
            </div>
            <div>
                <label class="block text-gray-300 mb-1">Nom</label>
                <input type="text" name="lastname" value="<?= htmlspecialchars($user['Lastname']) ?>" class="w-full rounded-lg glass-effect px-4 py-2 text-white focus:outline-none">
            </div>
            <div>
                <label class="block text-gray-300 mb-1">Email</label>
                <input type="email" name="mail" value="<?= htmlspecialchars($user['mail']) ?>" class="w-full rounded-lg glass-effect px-4 py-2 text-white focus:outline-none" required>
            </div>
            <button type="submit" class="w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-semibold py-3 rounded-full hover-lift mt-6">Enregistrer</button>
        </form>
    </div>
</body>
</html>