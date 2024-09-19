<x-app-layout title="Szczegóły Posta">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-white">Szczegóły posta: {{ $post->title }}</h1>
        <a href="{{ route('posts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Powrót do listy</a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-bold mb-4">Treść posta</h2>
        <p class="text-gray-700">{{ $post->body }}</p>

        <div class="mt-4 text-sm text-gray-500">
            Utworzył: {{ $post->customer->name ?? 'Anonim' }} | Data utworzenia: {{ $post->created_at->format('Y-m-d H:i') }}
        </div>
    </div>

    <div class="bg-gray-800 shadow-md rounded-lg p-6">
        <h2 class="text-xl font-bold text-white mb-4">Komentarze</h2>
        <table class="min-w-full bg-white rounded-lg">
            <thead class="bg-gray-50">
            <tr>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Komentarz</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Użytkownik</th>
                <th class="py-2 px-4 border-b text-left text-gray-700 font-semibold">Data utworzenia</th>
            </tr>
            </thead>
            <tbody>
            @foreach($post->comments as $comment)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $comment->body }}</td>
                    <td class="py-2 px-4 border-b">{{ $comment->customer->name ?? 'Anonim' }}</td>
                    <td class="py-2 px-4 border-b">{{ $comment->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
