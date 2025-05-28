<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registreren - KiteSurfschool Windkracht-12</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex,nofollow">
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 to-blue-100">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-extrabold tracking-wide">KiteSurfschool Windkracht-12</h1>
                <a href="{{ route('home') }}" class="text-white hover:underline">Terug naar Home</a>
            </div>
        </div>
    </header>

    <div class="min-h-[calc(100vh-180px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white w-full max-w-md p-8 rounded-2xl shadow-2xl space-y-8">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">
                    Word lid van onze surfcommunity
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Begin vandaag nog met je kitesurfavontuur!
                </p>
            </div>

            <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}" autocomplete="off">
                @csrf
                <input type="hidden" name="hidden" value="something" />  <!-- Chrome trick to disable autofill -->
                <div class="space-y-4">
                    <!-- Naam -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                        <input id="name" name="name" type="text" required 
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                                      focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                               autocomplete="off"
                               autocorrect="off"
                               autocapitalize="off"
                               spellcheck="false" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="email" name="email" type="email" required 
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                                      focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                               autocomplete="new-email"
                               autocorrect="off"
                               autocapitalize="off"
                               spellcheck="false" />
                    </div>

                    <!-- Wachtwoord -->
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700">Wachtwoord</label>
                        <input id="new-password" name="password" type="password" required 
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                                      focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                               autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Bevestig Wachtwoord -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Bevestig Wachtwoord</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" required 
                               class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400
                                      focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="{{ route('login') }}" class="font-medium text-blue-600 hover:text-blue-500">
                            Al een account?
                        </a>
                    </div>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg 
                                   transform transition-all duration-200 hover:scale-105 hover:shadow-lg">
                        Registreren
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 text-center">
        <p class="text-sm">&copy; 2024 KiteSurfschool Windkracht-12. Alle rechten voorbehouden.</p>
    </footer>
</body>
</html>
