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
        <h1 class="text-4xl font-bold mb-6">Klanten Overzicht</h1>
        <table class="table-auto w-full bg-white shadow-md rounded-lg">
            <thead>
                <tr class="bg-blue-600 text-white">
                    <th class="px-4 py-2">Naam</th>
                    <th class="px-4 py-2">Geboortedatum</th>
                    <th class="px-4 py-2">Pakket</th>
                    <th class="px-4 py-2">Adres</th>
                    <th class="px-4 py-2">Mobiel</th>
                    <th class="px-4 py-2">Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr class="border-b">
                        <td class="px-4 py-2">{{ $customer->full_name }}</td>
                        <td class="px-4 py-2">{{ $customer->date_of_birth }}</td>
                        <td class="px-4 py-2">{{ $customer->package_name ?? 'Geen pakket' }}</td>
                        <td class="px-4 py-2">{{ $customer->contact_details ?? 'Geen contactgegevens' }}</td>
                        <td class="px-4 py-2">{{ $customer->mobile ?? 'Geen mobiel' }}</td>
                        <td class="px-4 py-2">{{ $customer->email ?? 'Geen email' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
