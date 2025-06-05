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
    <style>
        body {
            animation: gradientBackground 10s infinite alternate;
            background: linear-gradient(135deg, #1e293b, #0f172a);
        }

        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }

        .hover-rotate:hover {
            transform: rotate(3deg);
            transition: transform 0.3s ease-in-out;
        }

        .button-pop:hover {
            transform: scale(1.1);
            transition: transform 0.3s ease-in-out;
        }

        .text-glow {
            animation: textGlow 2s infinite alternate;
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
                text-shadow: 0 0 10px #3b82f6, 0 0 20px #3b82f6;
            }

            to {
                text-shadow: 0 0 5px #3b82f6, 0 0 15px #3b82f6;
            }
        }
    </style>
</head>

<body class="bg-gray-800 text-gray-300 font-sans relative pb-20 fade-in">

    <?php require_once 'src/php/header.php'; ?>

    <!-- Wrapper flex centré sans toucher à la largeur -->
    <main class="mt-16 w-7/12 mx-auto px-4 py-12 pb-20 text-center fade-in">
        <div class="w-full max-w-md bg-gray-700 p-8 rounded-lg shadow-lg text-center mx-auto hover-rotate">
            <h2 class="text-3xl font-bold text-indigo-400 mb-6 text-glow">Connexion</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="text-red-600 bg-red-100 p-3 mb-4 rounded fade-in">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <form action="src/connect/login.php" method="post">
                <div class="mb-4 text-left fade-in">
                    <label for="uname" class="block text-sm font-medium text-gray-300">
                        Nom d'utilisateur
                    </label>
                    <input type="text" id="uname" name="uname"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>"
                           required>
                </div>

                <div class="mb-4 text-left fade-in">
                    <label for="pass" class="block text-sm font-medium text-gray-300">
                        Mot de passe
                    </label>
                    <input type="password" id="pass" name="pass"
                           class="mt-1 block w-full px-3 py-2 border border-gray-600 rounded-md shadow-sm
                                  focus:ring-blue-500 focus:border-blue-500 bg-gray-800 text-gray-300 sm:text-sm"
                           required>
                </div>

                <div class="flex flex-col space-y-4 fade-in">
                    <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition button-pop">
                        Connexion
                    </button>
                    <a href="signup.php" class="text-blue-400 hover:text-blue-500 hover-rotate">
                        Pas de compte ? Inscris-toi
                    </a>
                </div>
            </form>
        </div>
    </main>
    <?php require_once './src/php/footer.php'; ?>
</body>

</html>
