<x-app-layout title="Szczegóły profilu klienta">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Szczegóły klienta: {{ $profile->first_name }} {{ $profile->last_name }}</h1>
        <a href="{{ route('profiles.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Powrót do listy</a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Informacje o kliencie</h2>
        <p><strong>Email:</strong> {{ $profile->customer->email }}</p>
        <p><strong>Telefon:</strong> {{ $profile->phone ?? 'Brak telefonu' }}</p>
        <p><strong>Data urodzenia:</strong> {{ $profile->birthdate ?? 'Brak daty urodzenia' }}</p>
        <p><strong>Adres:</strong> {{ $profile->address ?? 'Brak adresu' }}</p>

        <div class="mt-4 text-sm text-gray-500">
            <p><strong>Utworzono:</strong> {{ $profile->created_at->format('Y-m-d H:i') }}</p>
        </div>
    </div>
</x-app-layout>
