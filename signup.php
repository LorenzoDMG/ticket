<?php
require_once 'src/php/dbconn.php';
require_once 'src/php/header.php'
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - e-ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #1e293b, #581c87);
            background-size: 500% 500%;
            animation: gradientShift 10s ease infinite;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(50px);
            animation: float 8s ease-in-out infinite;
        }
        
        .orb-1 {
            top: 5%;
            left: 10%;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.4), rgba(59, 130, 246, 0.1));
            animation-delay: 0s;
        }
        
        .orb-2 {
            top: 50%;
            right: 10%;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.4), rgba(139, 92, 246, 0.1));
            animation-delay: -3s;
        }
        
        .orb-3 {
            bottom: 15%;
            left: 30%;
            width: 160px;
            height: 160px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.4), rgba(236, 72, 153, 0.1));
            animation-delay: -1.5s;
        }
        
        .orb-4 {
            top: 25%;
            left: 70%;
            width: 120px;
            height: 120px;
            background: radial-gradient(circle, rgba(34, 197, 94, 0.3), rgba(34, 197, 94, 0.1));
            animation-delay: -4s;
        }
        
        .text-shimmer {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899, #22c55e, #3b82f6);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }
        
        .pulse-glow {
            animation: pulseGlow 4s ease-in-out infinite alternate;
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
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 4s ease-out forwards;
        }
        
        .signup-container {
            position: relative;
            overflow: hidden;
        }
        
        .signup-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: conic-gradient(
                from 0deg, 
                transparent, 
                rgba(59, 130, 246, 0.1), 
                transparent, 
                rgba(139, 92, 246, 0.1), 
                transparent, 
                rgba(236, 72, 153, 0.1), 
                transparent,
                rgba(34, 197, 94, 0.1),
                transparent
            );
            animation: rotate 25s linear infinite;
            z-index: -1;
        }
        
        .form-step {
            transition: all 0.5s ease-in-out;
        }
        
        .form-step.active {
            opacity: 1;
            transform: translateX(0);
        }
        
        .form-step.inactive {
            opacity: 0;
            transform: translateX(50px);
        }
        
        @keyframes gradientShift {
            0% { background-position: 0% 50% }
            50% { background-position: 100% 50% }
            100% { background-position: 0% 50% }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg) scale(1) }
            25% { transform: translateY(-20px) rotate(90deg) scale(1.1) }
            50% { transform: translateY(10px) rotate(180deg) scale(0.9) }
            75% { transform: translateY(-15px) rotate(270deg) scale(1.05) }
        }
        
        @keyframes shimmer {
            0% { background-position: 0% center }
            100% { background-position: 200% center }
        }
        
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3) }
            100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6), 0 0 80px rgba(139, 92, 246, 0.3) }
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
                opacity: 0.8;
                transform: translateY(-120px) scale(1);
            }
            100% {
                opacity: 0;
                transform: translateY(-250px) scale(0);
            }
        }
        
        @keyframes rotate {
            100% { transform: rotate(360deg) }
        }
        
        .progress-bar {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6, #ec4899);
            animation: progressGlow 2s ease-in-out infinite alternate;
        }
        
        @keyframes progressGlow {
            0% { box-shadow: 0 0 10px rgba(59, 130, 246, 0.5) }
            100% { box-shadow: 0 0 20px rgba(139, 92, 246, 0.8) }
        }

        @keyframes ripple {
            to {
                transform: scale(2);
                opacity: 0;
            }
        }
    </style>
</head>

<body class="gradient-bg min-h-screen relative overflow-hidden">
    <!-- Floating Orbs Background -->
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>
    <div class="floating-orb orb-4"></div>
    


    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-6 pt-20 pb-10">
        <div class="w-full max-w-lg">
            <div class="glass-effect rounded-3xl p-8 hover-lift pulse-glow signup-container">
                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold text-shimmer mb-2 stagger-fade">Créer un Compte</h2>
                    <p class="text-gray-400 stagger-fade" style="animation-delay: 0.2s">Rejoignez notre communauté en quelques clics</p>
                </div>

                <!-- Progress Bar -->
                <div class="mb-8 stagger-fade" style="animation-delay: 0.3s">
                    <div class="w-full bg-gray-700 rounded-full h-2">
                        <div class="progress-bar h-2 rounded-full transition-all duration-500 ease-out" style="width: 100%;"></div>
                    </div>
                    <p class="text-sm text-gray-400 mt-2 text-center">Étape 1/1 - Informations personnelles</p>
                </div>

                <?php if (isset($_GET['error'])): ?>
                    <div class="text-red-400 bg-red-500/10 border border-red-500/20 p-4 mb-6 rounded-xl backdrop-blur-sm stagger-fade animate-pulse" style="animation-delay: 0.4s">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl">❌</span>
                            <span><?= htmlspecialchars($_GET['error']) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['success'])): ?>
                    <div class="text-green-400 bg-green-500/10 border border-green-500/20 p-4 mb-6 rounded-xl backdrop-blur-sm stagger-fade animate-pulse" style="animation-delay: 0.4s">
                        <div class="flex items-center space-x-2">
                            <span class="text-xl">✅</span>
                            <span><?= htmlspecialchars($_GET['success']) ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="./src/connect/signup.php" method="post" class="space-y-6" id="signup-form">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="stagger-fade" style="animation-delay: 0.5s">
                            <label for="fname" class="block text-sm font-medium text-gray-300 mb-2">
                                <span class="flex items-center space-x-2">
                                    <span>👤</span>
                                    <span>Prénom</span>
                                </span>
                            </label>
                            <input type="text" id="fname" name="fname"
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                          focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                          text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                                   value="<?= isset($_GET['fname']) ? htmlspecialchars($_GET['fname']) : '' ?>"
                                   placeholder="Votre prénom"
                                   required>
                        </div>

                        <div class="stagger-fade" style="animation-delay: 0.6s">
                            <label for="lname" class="block text-sm font-medium text-gray-300 mb-2">
                                <span class="flex items-center space-x-2">
                                    <span>👤</span>
                                    <span>Nom</span>
                                </span>
                            </label>
                            <input type="text" id="lname" name="lname"
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                          focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                          text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                                   value="<?= isset($_GET['lname']) ? htmlspecialchars($_GET['lname']) : '' ?>"
                                   placeholder="Votre nom"
                                   required>
                        </div>
                    </div>

                    <div class="stagger-fade" style="animation-delay: 0.7s">
                        <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                            <span class="flex items-center space-x-2">
                                <span>📧</span>
                                <span>Email</span>
                            </span>
                        </label>
                        <input type="email" id="email" name="email"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                      focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                      text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                               value="<?= isset($_GET['email']) ? htmlspecialchars($_GET['email']) : '' ?>"
                               placeholder="votre.email@example.com"
                               required>
                    </div>

                    <div class="stagger-fade" style="animation-delay: 0.8s">
                        <label for="uname" class="block text-sm font-medium text-gray-300 mb-2">
                            <span class="flex items-center space-x-2">
                                <span>🔑</span>
                                <span>Nom d'utilisateur</span>
                            </span>
                        </label>
                        <input type="text" id="uname" name="uname"
                               class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                      focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                      text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                               value="<?= isset($_GET['uname']) ? htmlspecialchars($_GET['uname']) : '' ?>"
                               placeholder="Choisissez votre nom d'utilisateur"
                               required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="stagger-fade" style="animation-delay: 0.9s">
                            <label for="pass" class="block text-sm font-medium text-gray-300 mb-2">
                                <span class="flex items-center space-x-2">
                                    <span>🔒</span>
                                    <span>Mot de passe</span>
                                </span>
                            </label>
                            <input type="password" id="pass" name="pass"
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                          focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                          text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                                   placeholder="Mot de passe sécurisé"
                                   required>
                        </div>

                        <div class="stagger-fade" style="animation-delay: 1s">
                            <label for="confirm_pass" class="block text-sm font-medium text-gray-300 mb-2">
                                <span class="flex items-center space-x-2">
                                    <span>🔒</span>
                                    <span>Confirmer</span>
                                </span>
                            </label>
                            <input type="password" id="confirm_pass" name="confirm_pass"
                                   class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600/50 rounded-xl shadow-sm
                                          focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 
                                          text-gray-300 placeholder-gray-500 input-glow transition-all duration-300"
                                   placeholder="Confirmez votre mot de passe"
                                   required>
                        </div>
                    </div>

                    <div class="space-y-4 stagger-fade" style="animation-delay: 1.1s">
                        <div class="flex items-center space-x-3">
                            <input type="checkbox" id="terms" name="terms"
                                   class="w-4 h-4 text-blue-600 bg-gray-800 border-gray-600 rounded focus:ring-blue-500 focus:ring-2">
                            <label for="terms" class="text-sm text-gray-300">
                                J'accepte les <a href="#" class="text-blue-400 hover:text-blue-300 underline">termes et conditions</a>
                            </label>
                        </div>

                        <button type="submit" id="signup-btn"
                                class="w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-semibold py-3 px-6 rounded-xl
                                       hover:from-blue-600 hover:via-purple-600 hover:to-pink-600 
                                       transform hover:scale-105 transition-all duration-300 
                                       shadow-lg hover:shadow-xl magnetic-effect relative overflow-hidden">
                            <span class="relative z-10">Créer mon compte</span>
                        </button>
                        
                        <div class="text-center">
                            <a href="login.php" class="text-blue-400 hover:text-blue-300 transition-colors duration-300 magnetic-effect">
                                Déjà un compte ? <span class="underline decoration-wavy">Connecte-toi</span>
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
            particle.style.background = ['#3b82f6', '#8b5cf6', '#ec4899', '#22c55e'][Math.floor(Math.random() * 4)];
            
            document.getElementById('particle-container').appendChild(particle);
            
            setTimeout(() => {
                particle.remove();
            }, 4000);
        }

        // Signup Button Click Effect
        document.getElementById('signup-btn').addEventListener('click', function(e) {
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

        // Auto-generate ambient particles
        setInterval(() => {
            if (Math.random() > 0.8) {
                const x = Math.random() * window.innerWidth;
                const y = Math.random() * window.innerHeight;
                createParticle(x, y);
            }
        }, 2000);

        // Form validation with visual feedback
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            const inputs = this.querySelectorAll('input[required]');
            const password = document.getElementById('pass').value;
            const confirmPassword = document.getElementById('confirm_pass').value;
            const terms = document.getElementById('terms').checked;
            let isValid = true;
            
            // Check required fields
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
            
            // Check password match
            if (password !== confirmPassword) {
                document.getElementById('confirm_pass').style.borderColor = '#ef4444';
                document.getElementById('confirm_pass').style.boxShadow = '0 0 0 3px rgba(239, 68, 68, 0.3)';
                isValid = false;
                
                setTimeout(() => {
                    document.getElementById('confirm_pass').style.borderColor = '';
                    document.getElementById('confirm_pass').style.boxShadow = '';
                }, 3000);
            }
            
            // Check terms acceptance
            if (!terms) {
                document.getElementById('terms').parentElement.style.color = '#ef4444';
                isValid = false;
                
                setTimeout(() => {
                    document.getElementById('terms').parentElement.style.color = '';
                }, 3000);
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });

        // Password strength indicator
        const passwordInput = document.getElementById('pass');
        const strengthIndicator = document.createElement('div');
        strengthIndicator.className = 'mt-2 text-xs';
        passwordInput.parentElement.appendChild(strengthIndicator);

        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let feedback = '';
            
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            switch (strength) {
                case 0:
                case 1:
                    feedback = '<span class="text-red-400">Très faible</span>';
                    break;
                case 2:
                    feedback = '<span class="text-orange-400">Faible</span>';
                    break;
                case 3:
                    feedback = '<span class="text-yellow-400">Moyen</span>';
                    break;
                case 4:
                    feedback = '<span class="text-blue-400">Fort</span>';
                    break;
                case 5:
                    feedback = '<span class="text-green-400">Très fort</span>';
                    break;
            }
            
            strengthIndicator.innerHTML = password.length > 0 ? `Sécurité : ${feedback}` : '';
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