<x-app-layout title="Grupy Suplementów">
    <div class="flex justify-end mb-4">
        <a href="{{ route('supplements-group.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Powrót
        </a>
    </div>
    <div id="form-container" class="flex flex-col justify-start items-center text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-dark shadow-lg rounded-lg p-8 mt-8">
            <h3 class="text-3xl font-bold mb-8 text-left">{{ $group->getKey() ? 'Edytuj grupę suplementów' : 'Stwórz grupę suplementów' }}</h3>
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="form-group">
                        <label for="name" class="block text-sm font-medium text-gray-300">Nazwa</label>
                        <input type="text" name="name" value="{{ $group->name }}" id="name" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-gray-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-700 text-white py-2 px-3" placeholder="Wprowadź nazwę" required>
                    </div>
                    <div class="form-group sm:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-300">Opis</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-700 text-white py-2 px-3" placeholder="Wprowadź opis" required>{{ $group->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="image_path" class="block text-sm font-medium text-gray-300">Wybierz obraz</label>
                        <input type="file" name="image_path" id="image_path" class="mt-1 block w-full text-sm text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    @if($group->image_path)
                        <div class="form-group">
                            <img src="{{ asset("storage/public/$group->image_path") }}" alt="{{ $group->name }}" class="w-32 h-32">
                        </div>
                    @endif
                    <div class="form-group sm:col-span-2">
                        <x-checkbox name="Aktywny" :value="$group->status" field="status" />
                    </div>
                </div>
                <div class="mt-8 text-right">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Zapisz
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
