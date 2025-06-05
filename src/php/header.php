<?php session_start(); ?>

<script src="https://cdn.tailwindcss.com"></script>
<style>
    /* Styles du nouveau header */
    .glass-effect {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .text-shimmer {
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899, #3b82f6);
        background-size: 200% auto;
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: shimmer 3s linear infinite;
    }

    @keyframes shimmer {
        0% { background-position: 0% center }
        100% { background-position: 200% center }
    }

    nav#main-nav {
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    nav#main-nav.scrolled {
        transform: translateY(-10px);
        background-color: rgba(31, 41, 55, 0.9);
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.7), 0 0 50px rgba(59, 130, 246, 0.5);
    }

    .content {
        padding-top: 80px;
    }
    
    .magnetic-effect {
        transition: transform 0.3s ease-out;
    }
</style>

<script>
    // Effet magnétique pour les liens
    function initMagneticEffect() {
        document.querySelectorAll('.magnetic-effect').forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                el.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
            });
            
            el.addEventListener('mouseleave', () => {
                el.style.transform = 'translate(0px, 0px)';
            });
        });
    }

    // Effet de scroll
    document.addEventListener('DOMContentLoaded', () => {
        initMagneticEffect();
        
        // Gestion du scroll
        document.addEventListener('scroll', () => {
            const nav = document.querySelector('nav#main-nav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    });
</script>

<nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 glass-effect">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex items-center justify-between">
            <a href="/index.php" class="text-2xl font-bold text-shimmer">e-ticket</a>
            <div class="flex space-x-6">
                <a href="/src/php/profil.php" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 magnetic-effect">profil</a>
                
                <?php if (isset($_SESSION['id'])): ?>
                    <a href="/src/php/logout.php" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 magnetic-effect">logout</a>
                <?php else: ?>
                    <a href="/login.php" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 magnetic-effect">login</a>
                <?php endif; ?>
                
                <a href="/src/php/create_ticket.php" class="text-gray-300 hover:text-blue-400 transition-colors duration-300 magnetic-effect">ticket</a>
            </div>
        </div>
    </div>
</nav>
