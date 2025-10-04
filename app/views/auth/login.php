<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@700&family=IM+Fell+English&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
  body {
    font-family: 'IM Fell English', serif;
    background-color: #fae5b3;
  }
  .font-title {
    font-family: 'Cinzel Decorative', cursive;
    letter-spacing: 2px;
  }
  .btn-hover:hover {
    box-shadow: 0 0 12px gold, 0 0 24px crimson;
    transform: scale(1.05);
  }
</style>
</head>
<body class="min-h-screen flex items-center justify-center">

  <!-- Login Card -->
  <div class="bg-yellow-50 border-4 border-yellow-700 rounded-xl shadow-xl w-full max-w-sm p-8">
    <h1 class="font-title text-3xl text-center text-red-900 mb-6 flex items-center justify-center gap-2">
      <i class="fa-solid fa-hat-wizard text-yellow-700"></i> Login
    </h1>

    <form method="post" class="space-y-5">
      <div>
        <label class="block text-yellow-900 font-medium mb-1">Username</label>
        <input type="text" name="username" required
               class="w-full px-4 py-3 border-2 border-yellow-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-800 bg-yellow-100 placeholder-yellow-700">
      </div>

      <div>
        <label class="block text-yellow-900 font-medium mb-1">Password</label>
        <input type="password" name="password" required
               class="w-full px-4 py-3 border-2 border-yellow-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-800 bg-yellow-100 placeholder-yellow-700">
      </div>

      <button type="submit"
        class="w-full py-3 bg-gradient-to-r from-red-800 to-yellow-700 text-yellow-100 font-title text-lg rounded-lg shadow-lg btn-hover transition duration-300">
        <i class="fa-solid fa-right-to-bracket"></i> Login
      </button>
    </form>

    <p class="text-center text-yellow-900 mt-5 text-sm">
      Don't have an account?
      <a href="<?= site_url('/') ?>" class="text-red-800 font-semibold hover:underline">Register</a>
    </p>
  </div>

</body>
</html>
