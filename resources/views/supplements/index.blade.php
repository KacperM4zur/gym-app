<x-app-layout title="Suplementy">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Lorem Ipsum to po prostu fikcyjny tekst branży poligraficznej i składu.
        </div>
        <a href="{{ route('supplements.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Stwórz
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nazwa</th>
                <th class="py-2 px-4 border-b">Opis</th>
                <th class="py-2 px-4 border-b">Grupa</th>
                <th class="py-2 px-4 border-b">Zdjęcie</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Stworzono</th>
                <th class="py-2 px-4 border-b">Zaktualizowano</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($supplements as $supplement)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $supplement->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $supplement->description }}</td>
                    <td class="py-2 px-4 border-b">{{ $supplement->supplementsGroup->name }}</td>
                    <td class="py-2 px-4 border-b"><img src="{{ asset("storage/public/$supplement->image_path") }}" alt="{{ $supplement->name }}" class="w-16 h-16"></td>
                    <td class="py-2 px-4 border-b">{{ $supplement->status == 1 ? 'Aktywny' : 'Nieaktywny'}}</td>
                    <td class="py-2 px-4 border-b">{{ $supplement->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $supplement->updated_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('supplements.edit', ['id'=>$supplement->getKey()]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700 mr-2">Edycja</a>
                        <form action="{{ route('supplements.delete', ['id'=>$supplement->getKey()]) }}" method="POST" style="display:inline;">
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
