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
                        <div class="flex justify-between mb-4">
                            <h3 class="text-2xl font-bold">Mijn Leerlingen</h3>
                        </div>
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
                                            <div class="mt-4 flex justify-end space-x-2">
                                                <!-- Weer mail button -->
                                                <form action="{{ route('lessons.cancel-email', $package->user_package_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="type" value="weather">
                                                    <button type="submit" 
                                                            onclick="return confirm('Weet je zeker dat je de les wilt annuleren wegens het weer? Het pakket wordt hierna verwijderd.')"
                                                            class="bg-yellow-500 text-white py-2 px-4 rounded">
                                                        Weer Annulering
                                                    </button>
                                                </form>

                                                <!-- Ziekte mail button -->
                                                <form action="{{ route('lessons.cancel-email', $package->user_package_id) }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="type" value="illness">
                                                    <button type="submit"
                                                            onclick="return confirm('Weet je zeker dat je de les wilt annuleren wegens ziekte? Het pakket wordt hierna verwijderd.')"
                                                            class="bg-red-500 text-white py-2 px-4 rounded">
                                                        Ziekte Annulering
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @if($package->rejection)
                                            <div class="mt-4 bg-gray-100 rounded p-4">
                                                <h5 class="font-medium">Absentie Melding</h5>
                                                <p class="text-sm text-gray-600 mt-1">{{ $package->rejection->reason }}</p>
                                                @if($package->rejection->status === 'pending')
                                                    <div class="mt-3 flex space-x-2">
                                                        <form action="{{ route('rejections.handle', $package->rejection->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="approved">
                                                            <input type="hidden" name="response" value="Akkoord met absentie">
                                                            <button type="submit" class="px-3 py-1 text-sm bg-green-600 text-white rounded hover:bg-green-700">
                                                                Goedkeuren
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('rejections.handle', $package->rejection->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="denied">
                                                            <input type="hidden" name="response" value="Absentie afgewezen">
                                                            <button type="submit" class="px-3 py-1 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                                                Afwijzen
                                                            </button>
                                                        </form>
                                                    </div>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Je hebt nog geen leerlingen toegewezen gekregen.</p>
                        @endif
                    @elseif(Auth::user()->role === 'eigenaar')
                        <h3 class="text-2xl font-bold mb-6">Eigenaar Dashboard</h3>
                        <p class="text-gray-600">
                            Welkom in het beheerderspaneel. Gebruik de navigatiebalk hierboven om gebruikers, instructeurs en klanten te beheren.
                        </p>
                    @else
                        <h3 class="text-2xl font-bold mb-6">Mijn Pakketten</h3>
                        @if(isset($packages) && count($packages) > 0)
                            <div class="grid gap-6">
                                @foreach($packages as $package)
                                    <div class="bg-gray-50 rounded-lg p-6">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="text-xl font-bold text-blue-600">{{ $package->name }}</h4>
                                                <p class="text-gray-600">{{ $package->description }}</p>
                                                <p class="text-gray-600"><strong>Datum:</strong> {{ date('d-m-Y', strtotime($package->start_date)) }}</p>
                                                <p class="text-gray-600"><strong>Tijdslot:</strong> {{ $package->timeslot }}</p>
                                            </div>
                                            <button onclick="showAbsenceModal({{ $package->id }})" 
                                                    class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                <i class="fas fa-calendar-times"></i>
                                                Absentie melden
                                            </button>
                                        </div>
                                        @if($package->rejection)
                                            <div class="mt-2 text-sm">
                                                <span class="text-gray-600">Status: </span>
                                                <span class="@if($package->rejection->status === 'pending') text-yellow-600 
                                                             @elseif($package->rejection->status === 'approved') text-green-600 
                                                             @else text-red-600 @endif">
                                                    {{ ucfirst($package->rejection->status) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>Je hebt nog geen pakketten.</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <h3 class="text-lg font-bold mb-4">Pakket Afwijzen</h3>
            <form id="rejectForm" action="" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Reden voor afwijzing</label>
                    <textarea name="reason" required 
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                              rows="3"></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideRejectModal()"
                            class="bg-gray-500 text-white px-4 py-2 rounded">
                        Annuleren
                    </button>
                    <button type="submit" 
                            class="bg-red-600 text-white px-4 py-2 rounded">
                        Afwijzen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Absence Modal -->
    <div id="absenceModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-80 shadow-lg rounded-md bg-white">
            <div class="mb-4">
                <h3 class="text-lg font-medium text-gray-900">Absentie melden</h3>
                <p class="mt-1 text-sm text-gray-500">Geef aan waarom je niet aanwezig kunt zijn.</p>
            </div>
            
            <form id="absenceForm" action="" method="POST" class="space-y-4">
                @csrf
                <div>
                    <textarea name="reason" required 
                              class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                              rows="3"
                              placeholder="Reden voor absentie..."></textarea>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideAbsenceModal()"
                            class="px-3 py-1.5 text-sm text-gray-600 hover:text-gray-800">
                        Annuleren
                    </button>
                    <button type="submit" 
                            class="px-3 py-1.5 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Versturen
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showAbsenceModal(packageId) {
            document.getElementById('absenceForm').action = `/packages/${packageId}/reject`;
            document.getElementById('absenceModal').classList.remove('hidden');
        }

        function hideAbsenceModal() {
            document.getElementById('absenceModal').classList.add('hidden');
        }

        function sendCancellationMail(packageId, type) {
            if (confirm(`Weet je zeker dat je een ${type === 'weather' ? 'weer' : 'ziekte'} annuleringsmail wilt versturen?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = `/lessons/${packageId}/cancel-email`;
                
                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = document.querySelector('meta[name="csrf-token"]').content;
                
                const typeInput = document.createElement('input');
                typeInput.type = 'hidden';
                typeInput.name = 'type';
                typeInput.value = type;
                
                form.appendChild(csrf);
                form.appendChild(typeInput);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>

</x-app-layout>
