<x-app-layout title="Wpisy wagi">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Historia wagi użytkowników.
        </div>
        <a href="{{ route('users-weight.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Stwórz wpis
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Użytkownik</th>
                <th class="py-2 px-4 border-b">Waga (kg)</th>
                <th class="py-2 px-4 border-b">Data</th>
                <th class="py-2 px-4 border-b">Stworzono</th>
                <th class="py-2 px-4 border-b">Zaktualizowano</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($weights as $weight)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $weight->customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $weight->weight }}</td>
                    <td class="py-2 px-4 border-b">{{ $weight->date }}</td>
                    <td class="py-2 px-4 border-b">{{ $weight->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $weight->updated_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                            <a href="{{ route('users-weight.edit', ['id'=>$weight->getKey()]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edycja</a>
                            <form action="{{ route('users-weight.delete', ['id'=>$weight->getKey()]) }}" method="POST" style="display:inline;">
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
