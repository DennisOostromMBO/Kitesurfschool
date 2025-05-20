<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profiel Bewerken') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <form method="post" action="{{ route('profile.update') }}" class="mt-6">
                        @csrf
                        <input type="hidden" name="_method" value="post">

                        <!-- Persoonlijke Gegevens -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Persoonlijke Gegevens</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="first_name" :value="__('Voornaam')" />
                                    <x-text-input id="first_name" name="first_name" type="text" class="mt-1 block w-full" :value="old('first_name', $profile->first_name ?? '')" required />
                                </div>

                                <div>
                                    <x-input-label for="middle_name" :value="__('Tussenvoegsel')" />
                                    <x-text-input id="middle_name" name="middle_name" type="text" class="mt-1 block w-full" :value="old('middle_name', $profile->middle_name ?? '')" />
                                </div>

                                <div class="col-span-2">
                                    <x-input-label for="last_name" :value="__('Achternaam')" />
                                    <x-text-input id="last_name" name="last_name" type="text" class="mt-1 block w-full" :value="old('last_name', $profile->last_name ?? '')" required />
                                </div>

                                <div class="col-span-2">
                                    <x-input-label for="date_of_birth" :value="__('Geboortedatum')" />
                                    <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth', $profile->date_of_birth ?? '')" required />
                                </div>
                            </div>
                        </div>

                        <!-- Adresgegevens -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Adresgegevens</h3>
                            <div class="grid grid-cols-6 gap-4">
                                <div class="col-span-4">
                                    <x-input-label for="street_name" :value="__('Straatnaam')" />
                                    <x-text-input id="street_name" name="street_name" type="text" class="mt-1 block w-full" :value="old('street_name', $profile->street_name ?? '')" required />
                                </div>

                                <div>
                                    <x-input-label for="house_number" :value="__('Huisnummer')" />
                                    <x-text-input id="house_number" name="house_number" type="text" class="mt-1 block w-full" :value="old('house_number', $profile->house_number ?? '')" required />
                                </div>

                                <div>
                                    <x-input-label for="addition" :value="__('Toevoeging')" />
                                    <x-text-input id="addition" name="addition" type="text" class="mt-1 block w-full" :value="old('addition', $profile->addition ?? '')" />
                                </div>

                                <div class="col-span-2">
                                    <x-input-label for="postal_code" :value="__('Postcode')" />
                                    <x-text-input id="postal_code" name="postal_code" type="text" class="mt-1 block w-full" :value="old('postal_code', $profile->postal_code ?? '')" required />
                                </div>

                                <div class="col-span-4">
                                    <x-input-label for="city" :value="__('Stad')" />
                                    <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $profile->city ?? '')" required />
                                </div>
                            </div>
                        </div>

                        <!-- Contactgegevens -->
                        <div class="mb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Contactgegevens</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <x-input-label for="mobile" :value="__('Telefoonnummer')" />
                                    <x-text-input id="mobile" name="mobile" type="tel" class="mt-1 block w-full" :value="old('mobile', $profile->mobile ?? '')" required />
                                </div>

                                <div>
                                    <x-input-label for="email" :value="__('E-mailadres')" />
                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $profile->email ?? '')" required />
                                </div>
                            </div>
                        </div>

                        <div class="flex space-x-4 justify-end mt-6">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md">
                                {{ __('Opslaan') }}
                            </button>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md">
                                {{ __('Overslaan') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
