<?php
require_once 'src/php/dbconn.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - e-ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 text-gray-900 font-sans">

    <?php require_once 'src/php/header.php'; ?>

    <!-- Wrapper flex centré plein écran -->
    <div class="min-h-screen flex items-center justify-center px-4">
        <main class="w-7/12 px-4 py-12 text-center">
            <div class="max-w-md mx-auto bg-white p-8 rounded shadow-lg">
                <h2 class="text-2xl font-bold mb-6">Créé un compte</h2>

                <?php if (isset($_GET['error'])): ?>
                    <div class="text-red-600 bg-red-100 p-3 mb-4 rounded">
                        <?= htmlspecialchars($_GET['error']) ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <div class="text-green-600 bg-green-100 p-3 mb-4 rounded">
                        <?= htmlspecialchars($_GET['success']) ?>
                    </div>
                <?php endif; ?>

                <form action="./src/connect/signup.php" method="post">
                    <div class="mb-4 text-left">
                        <label for="fname" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                        <input type="text" id="fname" name="fname"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 sm:text-sm"
                               value="<?= isset($_GET['fname']) ? htmlspecialchars($_GET['fname']) : '' ?>"
                               required>
                    </div>

                    <div class="mb-4 text-left">
                        <label for="lname" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                        <input type="text" id="lname" name="lname"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 sm:text-sm"
                               value="<?= isset($_GET['lname']) ? htmlspecialchars($_GET['lname']) : '' ?>"
                               required>
                    </div>

                    <div class="mb-4 text-left">
                        <label for="uname" class="block text-sm font-medium text-gray-700 mb-2">Nom d'utilisateur</label>
                        <input type="text" id="uname" name="uname"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 sm:text-sm"
                               value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>"
                               required>
                    </div>

                    <div class="mb-4 text-left">
                        <label for="pass" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                        <input type="password" id="pass" name="pass"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 sm:text-sm"
                               required>
                    </div>

                    <div class="mb-4 text-left">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">E‑mail</label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 sm:text-sm"
                               value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>"
                               required>
                    </div>

                    <div class="flex flex-col space-y-4">
                        <button type="submit"
                                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                            Inscris-toi
                        </button>
                        <a href="login.php" class="text-blue-600 hover:text-blue-700">
                            Déjà un compte ? Connectez-vous.
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <footer class="bg-white border-t w-full text-center py-6 text-sm text-gray-500">
        © 2025 e-ticket. Tous droits réservés.
    </footer>

</body>

</html>
