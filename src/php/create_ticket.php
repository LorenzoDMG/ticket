<?php
require_once 'header.php';
require_once '../php/dbconn.php';
?>
<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = htmlspecialchars($_POST['title']);
    $description = htmlspecialchars($_POST['description']);

    // Simulate saving the ticket (e.g., to a database)
    $success = !empty($title) && !empty($description);

    if ($success) {
        try {
            $sql = "INSERT INTO Ticket (Title, Description) 
                    VALUES (?, ? )";
            $stmt = $db->prepare($sql);
            $stmt->execute([$title, $description]);
    
            header("Location: ../../index.php?success=Your account has been created successfully");  
            exit;
        } catch (PDOException $e) {
            $em = "Error: " . $e->getMessage();
            header("Location: ../../signup.php?error=$em&$data");
            exit;
        }
        $message = "Ticket created successfully!";
    } else {
        $message = "Please fill in all fields.";
    }
}

// Fetch all tickets from the database
$tickets = [];
$ticketsDb="SELECT * FROM Ticket";
$stmt = $db->prepare($ticketsDb);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
while ($row = $stmt->fetch()) {
    $tickets[] = $row;
}
$stmt->closeCursor();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket - e-ticket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            height: 90%;
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #1e293b);
            background-size: 350% 400%;
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
        
        .form-input {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            transform: translateY(-2px);
        }
        
        .ticket-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            transition: all 0.4s ease;
        }
        
        .ticket-card:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
        }
        
        .success-message {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.2), rgba(34, 197, 94, 0.1));
            border: 1px solid rgba(34, 197, 94, 0.3);
            animation: successPulse 2s ease-in-out;
        }
        
        .error-message {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.2), rgba(239, 68, 68, 0.1));
            border: 1px solid rgba(239, 68, 68, 0.3);
            animation: errorShake 0.5s ease-in-out;
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
        
        @keyframes successPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        
        @keyframes errorShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
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

        <div class="max-w-6xl mx-auto py-11">
            <!-- Page Header -->
            <div class="text-center mb-12 stagger-fade" style="animation-delay: 0.2s">
                <h1 class="text-5xl md:text-6xl font-extrabold mb-4 text-shimmer">
                    Gestion des Tickets
                </h1>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">
                    Créez et gérez vos tickets avec notre interface moderne et intuitive
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Create Ticket Form -->
                <div class="glass-effect rounded-3xl p-8 hover-lift pulse-glow stagger-fade" style="animation-delay: 0.6s">
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                            <span class="text-2xl">🎫</span>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-shimmer">Créer un Ticket</h2>
                            <p class="text-gray-400">Soumettez votre demande</p>
                        </div>
                    </div>

                    <?php if (isset($message)): ?>
                        <div class="mb-6 p-4 rounded-2xl <?= $success ? 'success-message text-green-300' : 'error-message text-red-300' ?> stagger-fade">
                            <div class="flex items-center">
                                <span class="text-2xl mr-3"><?= $success ? '✅' : '❌' ?></span>
                                <span class="font-medium"><?= $message ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <form action="" method="POST" class="space-y-6">
                        <div class="stagger-fade" style="animation-delay: 1s">
                            <label for="title" class="block text-sm font-semibold text-gray-300 mb-3">
                                <span class="flex items-center">
                                    <span class="text-lg mr-2">📝</span>
                                    Titre du ticket
                                </span>
                            </label>
                            <input 
                                type="text" 
                                id="title" 
                                name="title" 
                                class="form-input w-full px-4 py-4 rounded-xl text-gray-200 placeholder-gray-500 focus:outline-none"
                                placeholder="Décrivez brièvement votre demande..."
                                required
                            >
                        </div>

                        <div class="stagger-fade" style="animation-delay: 1.2s">
                            <label for="description" class="block text-sm font-semibold text-gray-300 mb-3">
                                <span class="flex items-center">
                                    <span class="text-lg mr-2">📄</span>
                                    Description détaillée
                                </span>
                            </label>
                            <textarea 
                                id="description" 
                                name="description" 
                                rows="6" 
                                class="form-input w-full px-4 py-4 rounded-xl text-gray-200 placeholder-gray-500 resize-none focus:outline-none"
                                placeholder="Expliquez en détail votre problème ou votre demande..."
                                required
                            ></textarea>
                        </div>

                        <button 
                            type="submit" 
                            id="submit-btn"
                            class="group relative w-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-semibold py-4 px-8 rounded-xl text-lg hover-lift magnetic-effect overflow-hidden stagger-fade"
                            style="animation-delay: 1.4s"
                        >
                            <span class="relative z-10 flex items-center justify-center">
                                <span class="text-2xl mr-3">🚀</span>
                                Créer le Ticket
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </button>
                    </form>
                </div>

                <!-- Tickets List -->
                <div class="glass-effect rounded-3xl p-8 hover-lift stagger-fade" style="animation-delay: 0.8s">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center">
                            <div class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 rounded-lg flex items-center justify-center mr-4">
                                <span class="text-2xl">📋</span>
                            </div>
                            <div>
                                <h2 class="text-3xl font-bold text-shimmer">Tickets Récents</h2>
                                <p class="text-gray-400">Vos dernières demandes</p>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-blue-500/20 to-purple-500/20 px-4 py-2 rounded-full border border-blue-500/30">
                            <span class="text-blue-400 font-semibold"><?= count($tickets) ?> tickets</span>
                        </div>
                    </div>

                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <?php if (empty($tickets)): ?>
                            <div class="text-center py-8 stagger-fade" style="animation-delay: 1.6s">
                                <div class="text-6xl mb-4">🎭</div>
                                <p class="text-gray-400 text-lg">Aucun ticket pour le moment</p>
                                <p class="text-gray-500 text-sm">Créez votre premier ticket pour commencer !</p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($tickets as $index => $ticket): ?>
                                <div class="ticket-card rounded-2xl p-6 stagger-fade" style="animation-delay: <?= 1.6 + ($index * 0.1) ?>s">
                                    <div class="flex items-start justify-between mb-4">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3">
                                                <span class="text-white font-bold">#<?= $ticket['Id'] ?></span>
                                            </div>
                                            <div>
                                                <h3 class="text-lg font-semibold text-blue-400 mb-1">
                                                    <?= htmlspecialchars($ticket['Title']) ?>
                                                </h3>
                                                <div class="flex items-center text-sm text-gray-400">
                                                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                                                    Actif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-300 mb-4 line-clamp-2">
                                        <?= htmlspecialchars($ticket['Description']) ?>
                                    </p>
                                    
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center text-sm text-gray-400">
                                            <span class="mr-4">📅 Aujourd'hui</span>
                                            <span>⏱️ En attente</span>
                                        </div>
                                        <a 
                                            href="ticket.php?id=<?= htmlspecialchars($ticket['Id']) ?>" 
                                            class="group inline-flex items-center text-blue-400 hover:text-blue-300 font-medium transition-all duration-300"
                                        >
                                            Voir détails
                                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
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

        // Form Enhancement
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0px)';
            });
        });

        // Submit Button Click Effect
        document.getElementById('submit-btn').addEventListener('click', function(e) {
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

        // Ticket cards hover animation
        document.querySelectorAll('.ticket-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0px) scale(1)';
            });
        });
    </script>

    <?php require_once 'footer.php'; ?>
</body>
</html>