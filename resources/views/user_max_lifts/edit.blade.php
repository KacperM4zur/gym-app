<x-app-layout title="Maksymalne Obciążenia">
    <div class="flex justify-end mb-4">
        <a href="{{ route('user-max-lifts.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Powrót
        </a>
    </div>

    <div id="form-container" class="flex flex-col justify-start items-center text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-dark shadow-lg rounded-lg p-8 mt-8">
            <h3 class="text-3xl font-bold mb-8">{{ $maxLift->getKey() ? 'Edytuj wpis' : 'Dodaj nowy wpis' }}</h3>
            <form method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="col-span-1">
                        <label for="customer_id" class="block text-sm font-medium text-gray-300">Klient</label>
                        <select name="customer_id" id="customer_id" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-gray-500 bg-gray-700 text-white py-2 px-3">
                            <option value="">Wybierz klienta</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $maxLift->customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="exercise_id" class="block text-sm font-medium text-gray-300">Ćwiczenie</label>
                        <select name="exercise_id" id="exercise_id" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-gray-500 bg-gray-700 text-white py-2 px-3">
                            <option value="">Wybierz ćwiczenie</option>
                            @foreach($exercises as $exercise)
                                <option value="{{ $exercise->id }}" {{ $maxLift->exercise_id == $exercise->id ? 'selected' : '' }}>{{ $exercise->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label for="weight" class="block text-sm font-medium text-gray-300">Waga (kg)</label>
                        <input type="text" name="weight" value="{{ $maxLift->weight }}" id="weight" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-gray-500 bg-gray-700 text-white py-2 px-3" required>
                    </div>
                    <div class="col-span-1">
                        <label for="date" class="block text-sm font-medium text-gray-300">Data</label>
                        <input type="date" name="date" value="{{ $maxLift->date }}" id="date" class="mt-1 block w-full border-gray-600 rounded-md shadow-sm focus:border-gray-500 bg-gray-700 text-white py-2 px-3" required>
                    </div>
                </div>

                <div class="mt-8 text-right">
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
