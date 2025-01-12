<x-app-layout title="Porady">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">Lista porad dla użytkowników</div>
        <a href="{{ route('advices.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Dodaj nową poradę</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Użytkownik</th>
                <th class="py-2 px-4 border-b">Treść porady</th>
                <th class="py-2 px-4 border-b">Data utworzenia</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($advices as $advice)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $advice->customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $advice->content }}</td>
                    <td class="py-2 px-4 border-b">{{ $advice->created_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('advices.edit', ['id'=>$advice->getKey()]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edytuj</a>
                        <form action="{{ route('advices.delete', ['id'=>$advice->getKey()]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
