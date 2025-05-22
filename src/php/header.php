<?php
session_start();
?>

<script src="https://cdn.tailwindcss.com"></script>

<header class="bg-gray-800 shadow-sm w-full fixed top-0">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="/index.php">
            <h1 class="text-3xl font-bold text-indigo-400">e-ticket</h1>
        </a>
        <nav class="space-x-6">
            <!-- PROFIL -->
            <a href="/src/php/profil.php" class="text-gray-300 hover:text-white hover:no-underline hover:scale-105 hover:bg-blue-500 px-3 py-2 rounded-lg transition duration-300">profil</a>
            <!-- LOGIN/LOGOUT -->
            <?php if (isset($_SESSION['id'])): ?>
                <a href="/src/php/logout.php" class="text-gray-300 hover:text-white hover:no-underline hover:scale-105 hover:bg-red-500 px-3 py-2 rounded-lg transition duration-300">logout</a>
            <?php else: ?>
                <a href="/login.php" class="text-gray-300 hover:text-white hover:no-underline hover:scale-105 hover:bg-blue-500 px-3 py-2 rounded-lg transition duration-300">login</a>
            <?php endif; ?>
            <!-- TICKET -->
            <a href="/src/php/create_ticket.php" class="text-gray-300 hover:text-white hover:no-underline hover:scale-105 hover:bg-blue-500 px-3 py-2 rounded-lg transition duration-300">ticket</a>
        </nav>
    </div>
</header>
