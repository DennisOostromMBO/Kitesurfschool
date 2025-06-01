<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel Bewerken') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="p-8">
                    <form method="post" action="{{ route('profile.update') }}">
                        @csrf
                        @method('post')
                        
                        <!-- Add update success message -->
                        @if(session('success'))
                            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Add form fields with proper names matching controller -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Voornaam</label>
                                <input type="text" name="first_name" value="{{ old('first_name', $profile->first_name) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('first_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tussenvoegsel</label>
                                <input type="text" name="middle_name" value="{{ old('middle_name', $profile->middle_name) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                @error('middle_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Achternaam</label>
                                <input type="text" name="last_name" value="{{ old('last_name', $profile->last_name) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('last_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Geboortedatum</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', $profile->date_of_birth) }}" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                @error('date_of_birth')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Section: Adresgegevens -->
                        <div class="mb-8">
                            <div class="flex items-center mb-6">
                                <div class="bg-green-500 rounded-full p-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-xl font-bold text-gray-900">Adresgegevens</h3>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-4">
                                    <label class="block text-sm font-medium text-gray-700">Straatnaam</label>
                                    <input type="text" name="street_name" value="{{ old('street_name', $profile->street_name) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('street_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Huisnummer</label>
                                    <input type="text" name="house_number" value="{{ old('house_number', $profile->house_number) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('house_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Toevoeging</label>
                                    <input type="text" name="addition" value="{{ old('addition', $profile->addition) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    @error('addition')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-2">
                                    <label class="block text-sm font-medium text-gray-700">Postcode</label>
                                    <input type="text" name="postal_code" value="{{ old('postal_code', $profile->postal_code) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('postal_code')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-4">
                                    <label class="block text-sm font-medium text-gray-700">Stad</label>
                                    <input type="text" name="city" value="{{ old('city', $profile->city) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('city')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section: Contactgegevens -->
                        <div class="mb-8">
                            <div class="flex items-center mb-6">
                                <div class="bg-purple-500 rounded-full p-2">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <h3 class="ml-3 text-xl font-bold text-gray-900">Contactgegevens</h3>
                            </div>

                            <div class="grid grid-cols-1 gap-6">
                                <div class="col-span-1">
                                    <label class="block text-sm font-medium text-gray-700">Telefoonnummer</label>
                                    <input type="tel" name="mobile" value="{{ old('mobile', $profile->mobile) }}" 
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                    @error('mobile')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div style="margin-top: 20px; padding: 20px 0; border-top: 1px solid #e5e7eb;">
                            <button type="submit" style="background-color: #2563eb; color: white; padding: 8px 16px; border-radius: 4px; display: inline-block;">Opslaan</button>
                            <a href="{{ route('dashboard') }}" style="background-color: #4b5563; color: white; padding: 8px 16px; border-radius: 4px; display: inline-block; margin-left: 16px;">Overslaan</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
