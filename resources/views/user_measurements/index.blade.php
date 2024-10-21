<x-app-layout title="Pomiary">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Pomiary użytkowników dla różnych partii ciała.
        </div>
        <a href="{{ route('user-measurements.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Dodaj pomiar
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Użytkownik</th>
                <th class="py-2 px-4 border-b">Partia ciała</th>
                <th class="py-2 px-4 border-b">Pomiar (cm)</th>
                <th class="py-2 px-4 border-b">Data</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($measurements as $measurement)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $measurement->customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $measurement->bodyPart->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $measurement->measurement }}</td>
                    <td class="py-2 px-4 border-b">{{ $measurement->date }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                            <a href="{{ route('user-measurements.edit', ['id' => $measurement->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edytuj</a>
                            <form action="{{ route('user-measurements.delete', ['id' => $measurement->id]) }}" method="POST">
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
