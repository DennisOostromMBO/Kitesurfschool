<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifieer Email - KiteSurfschool</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8 m-4">
            <div class="text-center">
                <h1 class="text-2xl font-bold text-gray-900 mb-4">
                    Controleer je email
                </h1>
                <p class="text-gray-600 mb-4">
                    We hebben een verificatie link gestuurd naar:<br>
                    <strong class="text-gray-900">{{ session('email') }}</strong>
                </p>
                <p class="text-gray-600">
                    Klik op de link in de email om je account te activeren en een wachtwoord in te stellen.
                </p>
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('home') }}" 
                   class="text-blue-600 hover:text-blue-800">
                    Terug naar homepage
                </a>
            </div>
        </div>
    </div>
</body>
</html>
