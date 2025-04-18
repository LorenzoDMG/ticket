<?php
require_once 'src/php/dbconn.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - e-ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800 font-sans">

    <?php require_once 'src/php/header.php'; ?>

    <!-- Wrapper flex centré sans toucher à la largeur -->
    <main class="min-h-screen flex items-center justify-center px-4">
        <!-- On garde max-w-md (≈28rem) ou w-7/12, comme tu préfères -->
        <div class="w-full max-w-md bg-white p-8 rounded shadow-lg text-center">
            <h2 class="text-2xl font-bold mb-6">Connexion</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="text-red-600 bg-red-100 p-3 mb-4 rounded">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

           </center> <form action="src/connect/login.php" method="post">
                <div class="mb-4 text-left">
                    <label for="uname" class="block text-sm font-medium text-gray-700">
                        Nom d'utilisateur
                    </label>
                    <input type="text" id="uname" name="uname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                                  focus:ring-blue-600 focus:border-blue-600 sm:text-sm"
                           value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>"
                           required>
                </div>

                <div class="mb-4 text-left">
                    <label for="pass" class="block text-sm font-medium text-gray-700">
                        Mot de passe
                    </label>
                    <input type="password" id="pass" name="pass"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm
                                  focus:ring-blue-600 focus:border-blue-600 sm:text-sm"
                           required>
                </div>

                <div class="flex flex-col space-y-4">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Connexion
                    </button>
                    <a href="signup.php" class="text-blue-600 hover:text-blue-700">
                        Pas de compte ? Inscris-toi
                    </a>
                </div>
            </form>
        </div>
    </main><center>
</body>

</html>
