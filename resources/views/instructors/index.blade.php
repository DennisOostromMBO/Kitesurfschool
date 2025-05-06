<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructeurs Overzicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-5xl font-bold text-blue-600 mb-8 text-center">Instructeurs Overzicht</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full bg-white shadow-lg rounded-lg">
                <thead>
                    <tr class="bg-blue-600 text-white">
                        <th class="px-6 py-4 text-left">Naam</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Mobiel</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($instructors as $instructor)
                        <tr class="border-b hover:bg-blue-50">
                            <td class="px-6 py-4">{{ $instructor->full_name }}</td>
                            <td class="px-6 py-4">{{ $instructor->email }}</td>
                            <td class="px-6 py-4">{{ $instructor->mobile }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
