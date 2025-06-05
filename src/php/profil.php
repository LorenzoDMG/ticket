<?php
require_once 'header.php';
require_once 'dbconn.php';
if (!isset($_SESSION['id'])) {
    header("Location: ../../login.php");
    exit();
}
// Récupération des informations depuis la session
$username = htmlspecialchars($_SESSION['fname'] . ' ' . $_SESSION['lname']);
$user_id = $_SESSION['id'];
// Récupérer le rôle de l'utilisateur depuis la base de données
$query = $db->prepare("SELECT Roles.Name AS role_name FROM Users
    JOIN Roles ON Users.Role_id = Roles.Id
    WHERE Users.Id = ?");
$query->execute([$user_id]);
$user_role = $query->fetch(PDO::FETCH_ASSOC)['role_name'] ?? 'Utilisateur';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - e-ticket</title>
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
            top: 20%;
            left: 10%;
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.3), rgba(59, 130, 246, 0.1));
            animation-delay: 0s;
        }
        
        .orb-2 {
            top: 60%;
            right: 15%;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.3), rgba(139, 92, 246, 0.1));
            animation-delay: -2s;
        }
        
        .orb-3 {
            bottom: 20%;
            left: 20%;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(236, 72, 153, 0.3), rgba(236, 72, 153, 0.1));
            animation-delay: -4s;
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
            animation: pulseGlow 2s ease-in-out infinite alternate;
        }
        
        .hover-lift {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .hover-lift:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
        }
        
        .stagger-fade {
            opacity: 0;
            transform: translateY(30px);
            animation: staggerFade 0.8s ease-out forwards;
        }
        
        .particle {
            position: absolute;
            background: #3b82f6;
            border-radius: 50%;
            pointer-events: none;
            animation: particleFloat 3s ease-out forwards;
        }
        
        .magnetic-effect {
            transition: transform 0.3s ease-out;
        }
        
        .profile-avatar {
            background: linear-gradient(45deg, #3b82f6, #8b5cf6, #ec4899);
            animation: avatarGlow 3s ease-in-out infinite alternate;
        }
        
        .info-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(59, 130, 246, 0.2);
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
            0% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.4) }
            100% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8), 0 0 60px rgba(59, 130, 246, 0.4) }
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
        
        @keyframes avatarGlow {
            0% { box-shadow: 0 0 30px rgba(59, 130, 246, 0.5) }
            100% { box-shadow: 0 0 50px rgba(139, 92, 246, 0.8), 0 0 80px rgba(236, 72, 153, 0.4) }
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

    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-6 pt-20">
        <div class="max-w-4xl mx-auto">
            <!-- Profile Section -->
            <div class="glass-effect rounded-3xl p-12 hover-lift pulse-glow">
                <!-- Profile Header -->
                <div class="text-center mb-12 stagger-fade" style="animation-delay: 0.2s">
                    <!-- Avatar -->
                    <div class="profile-avatar w-32 h-32 rounded-full mx-auto mb-6 flex items-center justify-center">
                        <span class="text-4xl font-bold text-white">
                            <?php echo strtoupper(substr($_SESSION['fname'], 0, 1) . substr($_SESSION['lname'], 0, 1)); ?>
                        </span>
                    </div>
                    
                    <h1 class="text-5xl md:text-6xl font-extrabold mb-4 text-shimmer">
                        Profil
                    </h1>
                    
                    <p class="text-xl text-gray-300 mb-2">
                        Bienvenue, <span class="text-blue-400 font-semibold"><?php echo $username; ?></span>
                    </p>
                    
                    <div class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500/20 to-purple-500/20 rounded-full border border-blue-500/30">
                        <span class="text-sm text-gray-300">Rôle :</span>
                        <span class="ml-2 text-sm font-semibold text-purple-400"><?php echo htmlspecialchars($user_role); ?></span>
                    </div>
                </div>
                
                <!-- Profile Information Cards -->
                <div class="grid md:grid-cols-2 gap-8 mb-12">
                    <div class="info-card rounded-2xl p-8 stagger-fade" style="animation-delay: 0.6s">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">👤</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-blue-400">Informations personnelles</h3>
                                <p class="text-gray-400 text-sm">Vos données de profil</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-gray-400 text-sm font-medium mb-1">Nom complet</label>
                                <p class="text-gray-200 text-lg font-semibold"><?php echo $username; ?></p>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm font-medium mb-1">ID Utilisateur</label>
                                <p class="text-gray-200 font-mono">#<?php echo str_pad($user_id, 6, '0', STR_PAD_LEFT); ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="info-card rounded-2xl p-8 stagger-fade" style="animation-delay: 1s">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">⚡</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-semibold text-purple-400">Permissions & Accès</h3>
                                <p class="text-gray-400 text-sm">Vos autorisations système</p>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-gray-400 text-sm font-medium mb-1">Rôle actuel</label>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-3 py-1 bg-gradient-to-r from-purple-500/20 to-pink-500/20 text-purple-300 rounded-full text-sm font-medium border border-purple-500/30">
                                        <?php echo htmlspecialchars($user_role); ?>
                                    </span>
                                </div>
                            </div>
                            <div>
                                <label class="block text-gray-400 text-sm font-medium mb-1">Statut</label>
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                                    <span class="text-green-400 text-sm font-medium">Actif</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center stagger-fade" style="animation-delay: 1.4s">
                    <button class="group relative bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-semibold py-4 px-8 rounded-full text-lg hover-lift magnetic-effect overflow-hidden">
                        <span class="relative z-10">Modifier le profil</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </button>
                    
                    <a href="logout.php" id="logout-btn" class="group relative bg-gradient-to-r from-red-500 to-red-600 text-white font-semibold py-4 px-8 rounded-full text-lg hover-lift magnetic-effect overflow-hidden">
                        <span class="relative z-10">🚪 Déconnexion</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-red-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                </div>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-4 mt-12 stagger-fade" style="animation-delay: 1.8s">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-400">0</div>
                        <div class="text-sm text-gray-400">Tickets créés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-purple-400">0</div>
                        <div class="text-sm text-gray-400">Tickets résolus</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-pink-400">0</div>
                        <div class="text-sm text-gray-400">Collaborations</div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Particle System -->
    <div id="particle-container" class="fixed inset-0 pointer-events-none z-10"></div>

    <script>
        // Magnetic Effect for Interactive Elements
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

        // Create particles on mouse move
        let particleTimer;
        document.addEventListener('mousemove', (e) => {
            if (particleTimer) clearTimeout(particleTimer);
            
            particleTimer = setTimeout(() => {
                if (Math.random() > 0.85) {
                    createParticle(e.clientX, e.clientY);
                }
            }, 50);
        });

        // Button Click Effects
        document.querySelectorAll('button, #logout-btn').forEach(button => {
            button.addEventListener('click', function(e) {
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
                    background: rgba(255, 255, 255, 0.5);
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
        });

        // Scroll-triggered animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stagger-fade').forEach(el => {
            observer.observe(el);
        });

        // Auto-generate ambient particles
        setInterval(() => {
            if (Math.random() > 0.7) {
                const x = Math.random() * window.innerWidth;
                const y = Math.random() * window.innerHeight;
                createParticle(x, y);
            }
        }, 2000);

        // Performance optimization: Reduce animations on low-end devices
        if (navigator.hardwareConcurrency && navigator.hardwareConcurrency < 4) {
            document.querySelectorAll('.floating-orb').forEach(orb => {
                orb.style.display = 'none';
            });
        }

        // Avatar click animation
        document.querySelector('.profile-avatar').addEventListener('click', function() {
            this.style.transform = 'scale(1.1) rotate(10deg)';
            setTimeout(() => {
                this.style.transform = 'scale(1) rotate(0deg)';
            }, 300);
        });
    </script>

    <?php require_once './footer.php'; ?>
</body>
</html>