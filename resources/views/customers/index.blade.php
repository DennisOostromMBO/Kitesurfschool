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
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
