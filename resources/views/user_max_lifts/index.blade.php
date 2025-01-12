<x-app-layout title="Maksymalne Obciążenia">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">Zarządzaj maksymalnymi obciążeniami dla ćwiczeń.</div>
        <a href="{{ route('user-max-lifts.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Dodaj Nowy</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Klient</th>
                <th class="py-2 px-4 border-b">Ćwiczenie</th>
                <th class="py-2 px-4 border-b">Waga (kg)</th>
                <th class="py-2 px-4 border-b">Data</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($maxLifts as $maxLift)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $maxLift->customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $maxLift->exercise->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $maxLift->weight }}</td>
                    <td class="py-2 px-4 border-b">{{ $maxLift->date }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex space-x-2">
                            <a href="{{ route('user-max-lifts.edit', ['id'=>$maxLift->getKey()]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edytuj</a>
                            <form action="{{ route('user-max-lifts.delete', ['id'=>$maxLift->getKey()]) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Usuń</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
