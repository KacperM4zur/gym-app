<x-app-layout title="Grupy ćwiczeń">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Lorem Ipsum to po prostu fikcyjny tekst branży poligraficznej i składu.
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="{{ route('exercises-group.edit') }}">
            Stwórz
        </button>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nazwa</th>
                <th class="py-2 px-4 border-b">Opis</th>
                <th class="py-2 px-4 border-b">Zdjęcie</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Stworzono</th>
                <th class="py-2 px-4 border-b">Zaktualizowano</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($exerciseGroups as $group)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $group->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $group->description }}</td>
                    <td class="py-2 px-4 border-b"><img src="{{ $group->image_path }}" alt="{{ $group->name }}" class="w-16 h-16"></td>
                    <td class="py-2 px-4 border-b">{{ $group->status == 1 ? 'Aktywny' : 'Nieaktywny'}}</td>
                    <td class="py-2 px-4 border-b">{{ $group->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $group->updated_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('exercises-group.edit', ['id'=>$group->getKey()]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700 mr-2">Edycja</a>
                        <form action="" method="POST" style="display:inline;">
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700">Usuń</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
