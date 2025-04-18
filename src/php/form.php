<?php
require_once 'header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <form class="bg-white p-6 rounded shadow-md w-full max-w-md">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">votre avis</h2>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">nom</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Your Name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">e-mail</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Your Email">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">message</label>
                <textarea id="message" name="message" rows="4" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Your Message"></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">envoyé</button>
        </form>
    </div>
</body>
</html>