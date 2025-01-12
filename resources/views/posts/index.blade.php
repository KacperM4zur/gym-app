<x-app-layout title="Lista Postów">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-white">Lista postów</h1>
{{--        <a href="{{ route('dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Powrót do Dashboardu</a>--}}
    </div>

    <div class="overflow-x-auto bg-gray-800 shadow-md rounded-lg p-4">
        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Tytuł</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Utworzył</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Data utworzenia</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $post->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $post->customer->name ?? 'Brak' }}</td>
                    <td class="py-2 px-4 border-b">{{ $post->created_at->format('Y-m-d H:i') }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('posts.show', $post->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
