<?php
session_start ();
var_dump ( $_SESSION["id"] );
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil - e-ticket</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans">

  <!-- Nav -->
  <?php require_once 'src/php/header.php'; ?>

  <!-- Main Content -->
  <!-- Ici on met un margin-top égal à la hauteur de votre nav (ex. 16 = 4rem) -->
  <main class="mt-16 w-7/12 mx-auto px-4 py-12 text-center">
    <h2 class="text-3xl font-bold mb-4">Bienvenue sur e-ticket</h2>
    <p class="text-gray-600 mb-8">
      Une interface claire, simple, et efficace pour vos besoins quotidiens.
    </p>
    <a href="./src/php/create_ticket.php"
       class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700 transition">
      Commencer
    </a>
  </main>
<?php require_once './src/php/footer.php'; ?>
</body>
</html>
