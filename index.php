<?php require_once 'src/php/header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accueil - e-ticket</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      animation: gradientBackground 10s infinite alternate;
      background: linear-gradient(135deg, #1e293b, #0f172a);
    }

    .fade-in {
      animation: fadeIn 1.5s ease-in-out;
    }

    .button-pop:hover {
      transform: scale(1.1) rotate(3deg);
      transition: transform 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
    }

    .hover-glow:hover {
      box-shadow: 0 0 20px #3b82f6, 0 0 40px #3b82f6;
      transition: box-shadow 0.4s ease-in-out;
    }

    .hover-scale:hover {
      transform: scale(1.1) translateY(-5px);
      transition: transform 0.4s ease-in-out;
    }

    .text-glow {
      animation: textGlow 2s infinite alternate;
    }

    .hover-bounce:hover {
      animation: bounce 0.6s infinite;
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

    @keyframes bounce {
      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }
    }
  </style>
</head>

<body class="bg-gray-800 text-gray-300 font-sans relative pb-20 fade-in">
  <!-- Nav -->

  <!-- Main Content -->
  <!-- Ici on met un margin-top égal à la hauteur de votre nav (ex. 16 = 4rem) -->
  <main class="mt-16 w-7/12 mx-auto px-4 py-12 pb-20 text-center fade-in">
    <h2 class="text-3xl font-bold text-indigo-400 mb-4 text-glow hover-scale hover-bounce">Bienvenue sur e-ticket
    </h2>
    <p class="text-gray-400 mb-8 fade-in hover-scale hover-bounce">
      Une interface claire, simple, et efficace pour vos besoins quotidiens.
    </p>
    <a href="./src/php/create_ticket.php"
      class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition button-pop hover-glow hover-bounce">
      Commencer
    </a>
  </main>
  <?php require_once './src/php/footer.php'; ?>
</body>

</html>