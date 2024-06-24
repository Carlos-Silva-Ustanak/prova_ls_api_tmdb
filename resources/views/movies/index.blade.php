<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to TMDb Movies</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white flex items-center justify-center min-h-screen">
    <div class="text-center">
        <h1 class="text-5xl font-bold mb-6">Welcome to TMDb Movies</h1>
        <div class="space-x-4 mb-8">
            <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded transition-colors duration-300">Login</a>
            <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded transition-colors duration-300">Register</a>
        </div>
    </div>
</body>
</html>
