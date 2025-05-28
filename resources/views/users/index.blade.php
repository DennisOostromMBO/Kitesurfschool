<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gebruikersbeheer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-blue-600 text-white">
                                <th class="px-6 py-3 text-left">Naam</th>
                                <th class="px-6 py-3 text-left">Email</th>
                                <th class="px-6 py-3 text-left">Huidige Rol</th>
                                <th class="px-6 py-3 text-left">Actie</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="px-6 py-4">{{ $user->name }}</td>
                                    <td class="px-6 py-4">{{ $user->email }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                                    <td class="px-6 py-4">
                                        @if($user->id === Auth::id())
                                            <span class="text-gray-500 italic">Kan eigen rol niet wijzigen</span>
                                        @else
                                            <form action="{{ route('users.update-role', $user->id) }}" 
                                                  method="POST" 
                                                  class="flex items-center space-x-2">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="rounded border-gray-300 mr-2">
                                                    <option value="klant" {{ $user->role === 'klant' ? 'selected' : '' }}>Klant</option>
                                                    <option value="instructor" {{ $user->role === 'instructor' ? 'selected' : '' }}>Instructor</option>
                                                    <option value="eigenaar" {{ $user->role === 'eigenaar' ? 'selected' : '' }}>Eigenaar</option>
                                                </select>
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                                                    Opslaan
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
