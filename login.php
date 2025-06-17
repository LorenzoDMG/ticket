<?php
require_once 'src/php/dbconn.php';
require_once 'src/php/header.php'
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - e-ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #1e293b);
            background-size: 400% 400%;
            animation: gradientShift 8s ease infinite;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(40px);
            animation: float 6s ease-in-out infinite;
        }
        
        .orb-1 {
            top: 10%;
            left: 20%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.4), rgba(59, 130, 246, 0.1));
            animation-delay: 0s;
        }
        
        .orb-2 {
            top: 70%;
            right: 20%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.3), rgba(139, 92, 246, 0.1));
            animation-delay: -3s;
        }
        
        .orb-3 {
            bottom: 10%;
            left: 40%;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.3), rgba(236, 72, 153, 0.1));
            animation-delay: -1.5s;
        }
        
        .text-shimmer {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899, #3b82f6);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 3s linear infinite;
        }
        
        .pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite alternate;
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .hover-lift:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.4);
        }
        
        .stagger-fade {
            opacity: 0;
            transform: translateY(30px);
            animation: staggerFade 0.8s ease-out forwards;
        }
        
        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3), 0 0 20px rgba(59, 130, 246, 0.2);
            transform: translateY(-2px);
            transition: all 0.3s ease;
        }
        
        .magnetic-effect {
            transition: transform 0.3s ease-out;
        }
        
        .particle {
            position: absolute;
            background: #3b82f6;
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 3s ease-out forwards;
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg) }
            33% { transform: translateY(-20px) rotate(120deg) }
            66% { transform: translateY(10px) rotate(240deg) }
        }
        
        @keyframes shimmer {
            0% { background-position: 0% center }
            100% { background-position: 200% center }
        }
        
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3) }
            100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6), 0 0 60px rgba(59, 130, 246, 0.3) }
        }
        
        @keyframes staggerFade {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes particleFloat {
            0% {
                opacity: 1;
                transform: translateY(0) scale(0);
            }
            50% {
                opacity: 0.7;
                transform: translateY(-100px) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-200px) scale(0);
            }
        }
        
        .login-container {
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(from 0deg, transparent, rgba(59, 130, 246, 0.1), transparent, rgba(139, 92, 246, 0.1), transparent);
            animation: rotate 20s linear infinite;
            z-index: -1;
        }
        
        @keyframes rotate {
            100% { transform: rotate(360deg) }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen relative overflow-hidden">
    <!-- Floating Orbs Background -->
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>


    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-6 pt-20">
        <div class="w-full max-w-md">
            <div class="glass-effect rounded-3xl p-8 hover-lift pulse-glow login-container">
                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold text-shimmer mb-2 stagger-fade">Connexion</h2>
                    <p class="text-gray-400 stagger-fade" style="animation-delay: 0.2s">Accédez à votre espace personnel</p>
                </div>

                <?php if (isset($_GET['error'])): ?>
                    <div class="text-red-400 bg-red-500/10 border border-red-500/20 p-4 mb-6 rounded-xl backdrop-blur-sm stagger-fade" style="animation-delay: 0.4s">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl">⚠️</span>
                            <span><?= htmlspecialchars($_GET['error']) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="src/connect/login.php" method="post" class="space-y-6">
                    <div class="stagger-fade" style="animation-delay: 0.6s">
                        <label for="uname" class="block text-sm font-medium text-gray-300 mb-2">
                            Nom d'utilisateur
                        </label>
                        <input type="text" id="uname" name="uname"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                      focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                      text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                               value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>"
                               placeholder="Entrez votre nom d'utilisateur"
                               required>
                    </div>

                    <div class="stagger-fade" style="animation-delay: 0.8s">
                        <label for="pass" class="block text-sm font-medium text-gray-300 mb-2">
                            Mot de passe
                        </label>
                        <input type="password" id="pass" name="pass"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                      focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                      text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                               placeholder="Entrez votre mot de passe"
                               required>
                    </div>

                    <div class="space-y-4 stagger-fade" style="animation-delay: 1s">
                        <button type="submit" id="login-btn"
                                class="w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-semibold py-3 px-6 rounded-xl
                                       hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 
                                       transform hover:scale-105 transition-all duration-300 
                                       shadow-lg hover:shadow-xl magnetic-effect relative overflow-hidden">
                            <span class="relative z-10">Se connecter</span>
                        </button>
                        
                        <div class="text-center">
                            <a href="signup.php" class="text-blue-400 hover:text-blue-300 transition-colors duration-300 magnetic-effect">
                                Pas de compte ? <span class="underline decoration-wavy">Inscris-toi</span>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <!-- Particle System -->
    <div id="particle-container" class="fixed inset-0 pointer-events-none z-10"></div>

    <script>
        // Magnetic Effect
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

        // Particle System
        function createParticle(x, y) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = x + 'px';
            particle.style.top = y + 'px';
            particle.style.width = Math.random() * 4 + 2 + 'px';
            particle.style.height = particle.style.width;
            
            document.getElementById('particle-container').appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 3000);
        }

        // Login Button Click Effect
        document.getElementById('login-btn').addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('div');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s linear;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });

        // Input focus effects
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
                createParticle(
                    this.getBoundingClientRect().left + Math.random() * this.offsetWidth,
                    this.getBoundingClientRect().top
                );
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        // Add ripple animation
        const style = document.createElement('style');
        style.textContent = `
            @keyframes ripple {
                to {
                    transform: scale(2);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);

        // Auto-generate ambient particles
        setInterval(() => {
            if (Math.random() > 0.8) {
                const x = Math.random() * window.innerWidth;
                const y = Math.random() * window.innerHeight;
                createParticle(x, y);
            }
        }, 2000);

        // Form validation with visual feedback
        document.querySelector('form').addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('input[required]');
            let isValid = true;
            
            inputs.forEach(input => {
                if (!input.value.trim()) {
                    input.style.borderColor = '#ef4444';
                    input.style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.3)';
                    isValid = false;
                    
                    setTimeout(() => {
                        input.style.borderColor = '';
                        input.style.boxShadow = '';
                    }, 3000);
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Scroll-triggered animations
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.stagger-fade').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>

</html>