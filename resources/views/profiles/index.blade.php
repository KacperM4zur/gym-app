<x-app-layout title="Lista profili klientów">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Lista profili klientów</h1>
    </div>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-gray-100">
            <tr>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Imię</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Nazwisko</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Email</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($profiles as $profile)
                <tr class="hover:bg-gray-50">
                    <td class="py-2 px-4 border-b">{{ $profile->first_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $profile->last_name }}</td>
                    <td class="py-2 px-4 border-b">{{ $profile->customer->email }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('profiles.show', $profile->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
