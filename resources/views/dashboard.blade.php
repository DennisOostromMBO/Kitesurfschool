<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @isset($package)
                        @if($package)
                            <div class="mb-6">
                                <h3 class="text-2xl font-bold mb-4">Jouw Pakket</h3>
                                <div class="bg-gray-50 rounded-lg p-6">
                                    <h4 class="text-xl font-bold text-blue-600">{{ $package->name }}</h4>
                                    <p class="mt-2 text-gray-600">{{ $package->description }}</p>
                                    <p class="mt-2 font-bold">€{{ number_format($package->price, 2, ',', '.') }}</p>
                                    <div class="mt-4 pt-4 border-t border-gray-200">
                                        <p class="text-gray-600"><strong>Locatie:</strong> {{ $package->location_name }}</p>
                                        <p class="text-gray-600"><strong>Datum:</strong> {{ date('d-m-Y', strtotime($package->start_date)) }}</p>
                                        <p class="text-gray-600"><strong>Tijdslot:</strong> {{ $package->timeslot }}</p>
                                        <p class="text-gray-600"><strong>Instructeur(s):</strong>
                                            @foreach($package->instructors as $instructor)
                                                {{ $instructor->instructor_name }}@if(!$loop->last), @endif
                                            @endforeach
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <p>Je hebt nog geen pakket gekocht.</p>
                        @endif
                    @else
                        <p>Je hebt nog geen pakket gekocht.</p>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
