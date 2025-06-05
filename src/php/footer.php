<style>
    footer {
        position: fixed;
        bottom: 0;
        width: 100%;
        z-index: 50;
        background-color: rgba(31, 41, 55, 0.8); /* Transparent background */
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.5), 0 0 40px rgba(59, 130, 246, 0.3); /* Glow effect */
        transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }
    footer.scrolled {
        transform: translateY(10px);
        background-color: rgba(31, 41, 55, 0.9); /* Slightly darker transparent background */
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.7), 0 0 50px rgba(59, 130, 246, 0.5); /* Stronger glow */
    }
</style>
<script>
    document.addEventListener('scroll', () => {
        const footer = document.querySelector('footer');
        if (window.scrollY > 50) {
            footer.classList.add('scrolled');
        } else {
            footer.classList.remove('scrolled');
        }
    });
</script>
<!-- Footer -->
<footer class="bg-gray-800 border-t border-gray-700 w-full">
    <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-400 text-center">
        © 2025 e-ticket. Tous droits réservés.
    </div>
</footer>