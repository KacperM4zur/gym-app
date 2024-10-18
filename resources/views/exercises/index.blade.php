<x-app-layout title="Ćwiczenia">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Lorem Ipsum to po prostu fikcyjny tekst branży poligraficznej i składu.
        </div>
        <a href="{{ route('exercises.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Stwórz
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nazwa</th>
                <th class="py-2 px-4 border-b">Opis</th>
                <th class="py-2 px-4 border-b">Technika</th>
                <th class="py-2 px-4 border-b">Wady</th>
                <th class="py-2 px-4 border-b">Zalety</th>
                <th class="py-2 px-4 border-b">Kategoria</th>
                <th class="py-2 px-4 border-b">Zdjęcie</th>
                <th class="py-2 px-4 border-b">Status</th>
                <th class="py-2 px-4 border-b">Stworzono</th>
                <th class="py-2 px-4 border-b">Zaktualizowano</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($exercises as $exercise)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $exercise->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->description }}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->technique }}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->advantages }}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->disadvantages }}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->exercisesGroup->name }}</td>
                    <td class="py-2 px-4 border-b"><img src="{{ asset("storage/public/$exercise->image_path") }}" alt="{{ $exercise->name }}" class="w-16 h-16"></td>
                    <td class="py-2 px-4 border-b">{{ $exercise->status == 1 ? 'Aktywny' : 'Nieaktywny'}}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $exercise->updated_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                            <a href="{{ route('exercises.edit', ['id'=>$exercise->getKey()]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edycja</a>
                            <form action="{{ route('exercises.delete', ['id'=>$exercise->getKey()]) }}" method="POST" style="display:inline;">
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
