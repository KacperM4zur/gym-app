<x-app-layout title="Role">
    <div class="flex justify-end mb-4">
        <a href="{{ route('roles.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Powrót
        </a>
    </div>

    <div id="form-container" class="flex flex-col justify-start items-center text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-dark shadow-lg rounded-lg p-8 mt-8">
            <h3 class="text-3xl font-bold mb-8 text-left">{{ $role->getKey() ? 'Edytuj rolę' : 'Stwórz rolę' }}</h3>
            <form method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="col-span-1">
                        <label for="name" class="block text-sm font-medium text-gray-300">Nazwa roli</label>
                        <input type="text" name="name" value="{{ $role->name }}" id="name" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-gray-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50 bg-gray-700 text-white py-2 px-3" placeholder="Wprowadź nazwę roli" required>
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