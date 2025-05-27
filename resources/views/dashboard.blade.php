<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(Auth::user()->role === 'instructor')
                        <h3 class="text-2xl font-bold mb-6">Mijn Leerlingen</h3>
                        @if(isset($instructorPackages) && count($instructorPackages) > 0)
                            <div class="grid gap-6">
                                @foreach($instructorPackages as $package)
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-xl font-bold text-blue-600">{{ $package->package_name }}</h4>
                                                <p class="text-gray-600">{{ $package->description }}</p>
                                            </div>
                                            <p class="font-bold">€{{ number_format($package->price, 2, ',', '.') }}</p>
                                        </div>
                                        <div class="mt-4 pt-4 border-t border-gray-200">
                                            <p class="text-gray-600"><strong>Student:</strong> {{ $package->student_name }}</p>
                                            <p class="text-gray-600"><strong>Email:</strong> {{ $package->student_email }}</p>
                                            <p class="text-gray-600"><strong>Locatie:</strong> {{ $package->location_name }}</p>
                                            <p class="text-gray-600"><strong>Datum:</strong> {{ date('d-m-Y', strtotime($package->start_date)) }}</p>
                                            <p class="text-gray-600"><strong>Tijdslot:</strong> {{ $package->timeslot }}</p>
                                            <div class="mt-4 flex justify-end">
                                                <form action="{{ route('packages.cancel', $package->user_package_id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit pakket wilt annuleren?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                        Pakket Annuleren
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Je hebt nog geen leerlingen toegewezen gekregen.</p>
                        @endif
                    @else
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
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
