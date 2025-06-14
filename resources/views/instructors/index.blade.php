<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeurs Overzicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Instructeurs Overzicht') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                            <thead>
                                <tr class="bg-blue-600 text-white">
                                    <th class="px-6 py-4 text-left">Naam</th>
                                    <th class="px-6 py-4 text-left">Email</th>
                                    <th class="px-6 py-4 text-left">Mobiel</th>
                                    @if(Auth::user()->role === 'eigenaar')
                                        <th class="px-6 py-4 text-left">Acties</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructors as $instructor)
                                    <tr class="border-b hover:bg-blue-50">
                                        <td class="px-6 py-4">{{ $instructor->full_name }}</td>
                                        <td class="px-6 py-4">{{ $instructor->email }}</td>
                                        <td class="px-6 py-4">{{ $instructor->mobile }}</td>
                                        @if(Auth::user()->role === 'eigenaar')
                                            <td class="px-6 py-4">
                                                <form action="{{ route('instructors.destroy', $instructor->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze instructeur wilt verwijderen?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center space-x-2">
                                                        <span>🗑️</span>
                                                        <span>Verwijderen</span>
                                                    </button>
                                                </form>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>
