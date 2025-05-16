<x-app-layout>
    <div class="container mx-auto px-6 py-12">
        <h1 class="text-3xl font-bold mb-6">Profielgegevens</h1>
        @if (session('success'))
            <div class="mb-4 text-green-600">{{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
            @csrf
            @method('PATCH')
            <div>
                <label for="name" class="block text-lg font-medium">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name', Auth::user()->name) }}" class="w-full border-gray-300 rounded-lg">
                @error('name') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="address" class="block text-lg font-medium">Adres</label>
                <input type="text" name="address" id="address" value="{{ old('address', Auth::user()->address ?? '') }}" class="w-full border-gray-300 rounded-lg">
                @error('address') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="city" class="block text-lg font-medium">Woonplaats</label>
                <input type="text" name="city" id="city" value="{{ old('city', Auth::user()->city ?? '') }}" class="w-full border-gray-300 rounded-lg">
                @error('city') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="date_of_birth" class="block text-lg font-medium">Geboortedatum</label>
                <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', Auth::user()->date_of_birth ?? '') }}" class="w-full border-gray-300 rounded-lg">
                @error('date_of_birth') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="mobile" class="block text-lg font-medium">Mobiel</label>
                <input type="text" name="mobile" id="mobile" value="{{ old('mobile', Auth::user()->mobile ?? '') }}" class="w-full border-gray-300 rounded-lg">
                @error('mobile') <span class="text-red-600">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg">Opslaan</button>
        </form>
    </div>
</x-app-layout>
