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

<body class="bg-gray-800 text-gray-300 font-sans relative pb-20">

    <?php require_once 'src/php/header.php'; ?>

    <!-- Wrapper flex centré sans toucher à la largeur -->
    <main class="mt-16 w-7/12 mx-auto px-4 py-12 pb-20 text-center">
        <div class="w-full max-w-md bg-gray-700 p-8 rounded-lg shadow-lg text-center mx-auto">
            <h2 class="text-3xl font-bold text-indigo-400 mb-6">Créer un Compte</h2>

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

            <form action="./src/connect/signup.php" method="post" class="space-y-4">
                <div class="mb-4 text-left">
                    <label for="fname" class="block text-sm font-medium text-gray-300">Prénom</label>
                    <input type="text" id="fname" name="fname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['fname']) ? htmlspecialchars($_GET['fname']) : '' ?>" required>
                </div>
                <div class="mb-4 text-left">
                    <label for="lname" class="block text-sm font-medium text-gray-300">Nom</label>
                    <input type="text" id="lname" name="lname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['lname']) ? htmlspecialchars($_GET['lname']) : '' ?>" required>
                </div>
                <div class="mb-4 text-left">
                    <label for="uname" class="block text-sm font-medium text-gray-300">Nom d'utilisateur</label>
                    <input type="text" id="uname" name="uname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>" required>
                </div>
                <div class="mb-4 text-left">
                    <label for="pass" class="block text-sm font-medium text-gray-300">Mot de passe</label>
                    <input type="password" id="pass" name="pass"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           required>
                </div>
                <div class="mb-4 text-left">
                    <label for="email" class="block text-sm font-medium text-gray-300">E‑mail</label>
                    <input type="email" id="email" name="email"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>" required>
                </div>
                <div class="flex flex-col space-y-4">
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Inscris-toi
                    </button>
                    <a href="login.php" class="text-blue-400 hover:text-blue-500">
                        Déjà un compte ? Connectez-vous.
                    </a>
                </div>
            </form>
        </div>
    </main>

    <?php require_once 'src/php/footer.php'; ?>

</body>

</html>
