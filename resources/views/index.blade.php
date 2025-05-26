<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KiteSurfschool Windkracht-12</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">

    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-4xl font-extrabold tracking-wide">KiteSurfschool Windkracht-12</h1>
            @if (Auth::check())
                <div class="flex items-center space-x-4 relative">
                    <p class="text-lg">Welkom, {{ Auth::user()->name }}!</p>
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="text-white hover:underline focus:outline-none">
                            Menu <i class="fas fa-chevron-down ml-1"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-40 bg-white text-gray-900 rounded shadow-lg z-50">
                            <a href="{{ route('dashboard') }}" class="block px-4 py-2 hover:bg-gray-100">Dashboard</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profiel</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Uitloggen</button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}" class="text-white hover:underline">Inloggen</a>
                    <a href="{{ route('register') }}" class="text-white hover:underline">Registeren</a>
                </div>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative w-full h-[70vh] bg-cover bg-center flex items-center justify-center text-white" 
        style="background-image: url('{{ asset('img/background.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-blue-900 via-transparent to-blue-900 opacity-80"></div>
        <div class="relative z-10 text-center px-6">
            <h1 class="text-5xl md:text-6xl font-extrabold tracking-wide">
                Welkom bij KiteSurfschool Windkracht-12
            </h1>
            <p class="text-lg md:text-xl mt-4 opacity-90">
                Ontdek de magie van kitesurfen met onze ervaren instructeurs.
            </p>
            <a href="#packages" 
                class="mt-6 inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full text-lg shadow-lg transition-transform transform hover:scale-105">
                Bekijk Onze Pakketten
            </a>
        </div>
    </section>

    <!-- Over Ons -->
    <section id="about" class="py-20 bg-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl font-bold mb-8">Over KiteSurfschool Windkracht-12</h2>
            <p class="text-xl leading-relaxed max-w-3xl mx-auto">
                Kitesurfen is een spannende watersport waarbij je over het water glijdt met de kracht van de wind. 
                Onze ervaren instructeurs helpen je veilig en snel de techniek onder de knie te krijgen.
            </p>
            <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                    <i class="fas fa-wind text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-2">Ervaren Instructeurs</h3>
                    <p class="text-gray-700">Onze instructeurs hebben jarenlange ervaring en zorgen voor een veilige en leuke ervaring.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                    <i class="fas fa-water text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-2">Perfecte Locaties</h3>
                    <p class="text-gray-700">We geven les op de mooiste en veiligste locaties in Nederland.</p>
                </div>
                <div class="p-6 bg-gray-100 rounded-lg shadow-md">
                    <i class="fas fa-star text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-2">Hoogwaardige Materialen</h3>
                    <p class="text-gray-700">Wij gebruiken alleen de beste materialen voor een optimale ervaring.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pakketten -->
    <section id="packages" class="py-20 bg-gray-100 text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl font-bold mb-12">Onze Pakketten</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach ($packages as $package)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <div class="relative">
                            <img src="{{ asset('img/paket' . $loop->iteration . '.jpg') }}" 
                                 class="w-full h-48 object-cover" 
                                 alt="{{ $package->name }}">
                            <div class="absolute top-0 right-0 bg-blue-600 text-white px-4 py-2 rounded-bl-lg">
                                €{{ number_format($package->price, 2, ',', '.') }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col h-64">
                            <h3 class="text-2xl font-bold mb-3 text-blue-600">{{ $package->name }}</h3>
                            <p class="text-gray-600 flex-grow">{{ $package->description }}</p>
                            @auth
                                <button class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transform hover:scale-105 transition-all duration-200 shadow-md">
                                    Koop Pakket
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="mt-4 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transform hover:scale-105 transition-all duration-200 shadow-md inline-block text-center">
                                    Koop Pakket
                                </a>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact -->
    <section id="contact" class="py-20 bg-white text-center">
        <div class="container mx-auto px-6">
            <h2 class="text-5xl font-bold mb-8">Contact</h2>
            <p class="text-xl mb-6">Neem contact op voor meer informatie of om een les te boeken.</p>
            <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-8">
                <p class="text-lg"><strong>Email:</strong> <a href="mailto:info@kitesurfschool.nl" class="text-blue-600 hover:underline">info@kitesurfschool.nl</a></p>
                <p class="text-lg"><strong>Telefoon:</strong> <a href="tel:+31612345678" class="text-blue-600 hover:underline">06-12345678</a></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 text-center">
        <div class="container mx-auto px-6">
            <p class="text-lg">&copy; 2024 KiteSurfschool Windkracht-12. Alle rechten voorbehouden.</p>
            <div class="mt-4 flex justify-center space-x-4">
                <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white hover:text-blue-400"><i class="fab fa-twitter"></i></a>
            </div>
        </div>
    </footer>

    <!-- Voeg Alpine.js toe voor de dropdown -->
    <script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>
