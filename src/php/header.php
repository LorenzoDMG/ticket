<?php
session_start();
?>

<script src="https://cdn.tailwindcss.com"></script>
<style>
    header {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 50;
        background-color: rgba(31, 41, 55, 0.8); /* Transparent background */
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5), 0 0 40px rgba(59, 130, 246, 0.3); /* Glow effect */
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    header.scrolled {
        transform: translateY(-10px);
        background-color: rgba(31, 41, 55, 0.9); /* Slightly darker transparent background */
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.7), 0 0 50px rgba(59, 130, 246, 0.5); /* Stronger glow */
    }
    .content {
        padding-top: 80px; /* Adjust this value to match the header height */
    }
</style>
<script>
    document.addEventListener('scroll', () => {
        const header = document.querySelector('header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
</script>

<header class="bg-gray-800 shadow-sm w-full">
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
<div class="content">
    <!-- ...existing code for the page content... -->
</div>
