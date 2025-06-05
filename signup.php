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
    <style>
        body {
            animation: gradientBackground 10s infinite alternate;
            background: linear-gradient(135deg, #1e293b, #0f172a);
        }

        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }

        .hover-glow:hover {
            box-shadow: 0 0 30px #3b82f6, 0 0 60px #3b82f6;
            transition: box-shadow 0.4s ease-in-out;
        }

        .hover-scale:hover {
            transform: scale(1.1) translateY(-5px);
            transition: transform 0.4s ease-in-out;
        }

        .text-glow {
            animation: textGlow 2s infinite alternate;
        }

        .button-glow:hover {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
            box-shadow: 0 0 20px #3b82f6, 0 0 40px #60a5fa;
            transition: background 0.4s ease-in-out, box-shadow 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes gradientBackground {
            from {
                background: linear-gradient(135deg, #1e293b, #0f172a);
            }
            to {
                background: linear-gradient(135deg, #0f172a, #1e293b);
            }
        }

        @keyframes textGlow {
            from {
                text-shadow: 0 0 20px #3b82f6, 0 0 40px #3b82f6;
            }
            to {
                text-shadow: 0 0 10px #3b82f6, 0 0 30px #3b82f6;
            }
        }
    </style>
</head>
<body class="bg-gray-800 text-gray-300 font-sans relative pb-20 fade-in">
    <?php require_once 'src/php/header.php'; ?>

    <!-- Wrapper flex centré sans toucher à la largeur -->
    <main class="mt-16 w-7/12 mx-auto px-4 py-12 pb-20 text-center fade-in">
        <div class="w-full max-w-md bg-gray-700 p-8 rounded-lg shadow-lg text-center mx-auto hover-glow">
            <h2 class="text-3xl font-bold text-indigo-400 mb-6 text-glow">Créer un Compte</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="text-red-600 bg-red-100 p-3 mb-4 rounded fade-in">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="text-green-600 bg-green-100 p-3 mb-4 rounded fade-in">
                    <?= htmlspecialchars($_GET['success']) ?>
                </div>
            <?php endif; ?>

            <form action="./src/connect/signup.php" method="post" class="space-y-4 fade-in">
                <div class="mb-4 text-left hover-scale">
                    <label for="fname" class="block text-sm font-medium text-gray-300">Prénom</label>
                    <input type="text" id="fname" name="fname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['fname']) ? htmlspecialchars($_GET['fname']) : '' ?>" required>
                </div>
                <div class="mb-4 text-left hover-scale">
                    <label for="lname" class="block text-sm font-medium text-gray-300">Nom</label>
                    <input type="text" id="lname" name="lname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['lname']) ? htmlspecialchars($_GET['lname']) : '' ?>" required>
                </div>
                <div class="mb-4 text-left hover-scale">
                    <label for="uname" class="block text-sm font-medium text-gray-300">Nom d'utilisateur</label>
                    <input type="text" id="uname" name="uname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>" required>
                </div>
                <div class="mb-4 text-left hover-scale">
                    <label for="pass" class="block text-sm font-medium text-gray-300">Mot de passe</label>
                    <input type="password" id="pass" name="pass"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           required>
                </div>
                <div class="mb-4 text-left hover-scale">
                    <label for="email" class="block text-sm font-medium text-gray-300">E‑mail</label>
                    <input type="email" id="email" name="email"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>" required>
                </div>
                <div class="flex flex-col space-y-4">
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition button-glow">
                        Inscris-toi
                    </button>
                    <a href="login.php" class="text-blue-400 hover:text-blue-500 hover-glow">
                        Déjà un compte ? Connectez-vous.
                    </a>
                </div>
            </form>
        </div>
    </main>

    <?php require_once 'src/php/footer.php'; ?>
</body>
</html>
