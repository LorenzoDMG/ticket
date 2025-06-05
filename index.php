<?php
require_once 'src/php/header.php'
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accueil - e-ticket</title>
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
        
        .typing-animation {
            overflow: hidden;
            border-right: 2px solid #3b82f6;
            white-space: nowrap;
            animation: typing 4s steps(40, end), blink-caret 0.75s step-end infinite;
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
        
        @keyframes typing {
            from { width: 0 }
            to { width: 100% }
        }
        
        @keyframes blink-caret {
            from, to { border-color: transparent }
            50% { border-color: #3b82f6 }
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
        
        .magnetic-effect {
            transition: transform 0.3s ease-out;
        }
    </style>
</head>
<body class="gradient-bg min-h-screen relative overflow-hidden">
    <!-- Floating Orbs Background -->
    <div class="floating-orb orb-1"></div>
    <div class="floating-orb orb-2"></div>
    <div class="floating-orb orb-3"></div>


    <!-- Main Content -->
    <main class="min-h-screen flex items-center justify-center px-6">
        <div class="max-w-4xl mx-auto text-center">
            <!-- Hero Section -->
            <div class="glass-effect rounded-3xl p-12 hover-lift pulse-glow">
                <h1 class="text-6xl md:text-8xl font-extrabold mb-6 text-shimmer stagger-fade" style="animation-delay: 0.2s">
                    e-ticket
                </h1>
                
                <div class="typing-animation text-xl md:text-2xl text-gray-300 mb-8 stagger-fade" style="animation-delay: 0.6s" id="typing-text">
                    Une interface révolutionnaire pour vos besoins quotidiens
                </div>
                
                <p class="text-lg text-gray-400 mb-12 max-w-2xl mx-auto leading-relaxed stagger-fade" style="animation-delay: 1s">
                    Découvrez une expérience utilisateur moderne, fluide et intuitive. 
                    Gérez vos tickets avec élégance et efficacité.
                </p>
                
                <!-- CTA Button -->
                <button id="cta-button" class="group relative bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 text-white font-semibold py-4 px-12 rounded-full text-xl hover-lift magnetic-effect stagger-fade overflow-hidden" style="animation-delay: 1.4s">
                    <span class="relative z-10">Commencer l'aventure</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                
                <!-- Feature Cards -->
                <div class="grid md:grid-cols-3 gap-8 mt-16">
                    <div class="glass-effect rounded-2xl p-6 hover-lift stagger-fade" style="animation-delay: 1.8s">
                        <div class="text-4xl mb-4">🚀</div>
                        <h3 class="text-xl font-semibold text-blue-400 mb-2">Rapide</h3>
                        <p class="text-gray-400">Interface ultra-responsive et optimisée</p>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 hover-lift stagger-fade" style="animation-delay: 2.2s">
                        <div class="text-4xl mb-4">🎨</div>
                        <h3 class="text-xl font-semibold text-purple-400 mb-2">Moderne</h3>
                        <p class="text-gray-400">Design contemporain et élégant</p>
                    </div>
                    
                    <div class="glass-effect rounded-2xl p-6 hover-lift stagger-fade" style="animation-delay: 2.6s">
                        <div class="text-4xl mb-4">⚡</div>
                        <h3 class="text-xl font-semibold text-pink-400 mb-2">Efficace</h3>
                        <p class="text-gray-400">Gestion simplifiée de vos tickets</p>
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

        // CTA Button Click Effect
        document.getElementById('cta-button').addEventListener('click', function(e) {
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
            
            // Simulate navigation
            setTimeout(() => {
                window.location.href = './src/php/create_ticket.php';
            }, 300);
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

        // Dynamic typing effect completion
        setTimeout(() => {
            const typingEl = document.getElementById('typing-text');
            typingEl.style.borderRight = 'none';
        }, 4000);

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
    </script>
</body>
</html>