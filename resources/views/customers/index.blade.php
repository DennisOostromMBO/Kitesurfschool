<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klanten Overzicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="container mx-auto px-6 py-8">
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <h1 class="text-5xl font-bold text-blue-600 mb-8 text-center">Klanten Overzicht</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-6 py-4 text-left">Naam</th>
                        <th class="px-6 py-4 text-left">Geboortedatum</th>
                        <th class="px-6 py-4 text-left">Pakket</th>
                        <th class="px-6 py-4 text-left">Adres</th>
                        <th class="px-6 py-4 text-left">Mobiel</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Acties</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr class="border-b hover:bg-blue-50">
                            <td class="px-6 py-4">{{ $customer->full_name }}</td>
                            <td class="px-6 py-4">{{ $customer->date_of_birth }}</td>
                            <td class="px-6 py-4">{{ $customer->package_name ?? 'Geen pakket' }}</td>
                            <td class="px-6 py-4">{{ $customer->contact_details ?? 'Geen contactgegevens' }}</td>
                            <td class="px-6 py-4">{{ $customer->mobile ?? 'Geen mobiel' }}</td>
                            <td class="px-6 py-4">{{ $customer->email ?? 'Geen email' }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze klant wilt verwijderen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center space-x-2">
                                        <span>🗑️</span>
                                        <span>Verwijderen</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
