<x-app-layout title="Pomiary">
    <div class="flex justify-end mb-4">
        <a href="{{ route('user-measurements.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Powrót
        </a>
    </div>
    <div id="form-container" class="flex flex-col justify-start items-center text-white py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-4xl bg-dark shadow-lg rounded-lg p-8 mt-8">
            <h3 class="text-3xl font-bold mb-8 text-left">{{ $measurement->exists ? 'Edytuj pomiar' : 'Dodaj pomiar' }}</h3>
            <form method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="col-span-1">
                        <label for="customer_id" class="block text-sm font-medium text-gray-300">Użytkownik</label>
                        <select name="customer_id" id="customer_id" class="mt-1 block w-full bg-gray-700 text-white py-2 px-3" required>
                            <option value="">Wybierz użytkownika</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ $measurement->customer_id == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="body_part_id" class="block text-sm font-medium text-gray-300">Partia ciała</label>
                        <select name="body_part_id" id="body_part_id" class="mt-1 block w-full bg-gray-700 text-white py-2 px-3" required>
                            <option value="">Wybierz partię ciała</option>
                            @foreach($bodyParts as $part)
                                <option value="{{ $part->id }}" {{ $measurement->body_part_id == $part->id ? 'selected' : '' }}>
                                    {{ $part->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="measurement" class="block text-sm font-medium text-gray-300">Pomiar (cm)</label>
                        <input type="number" name="measurement" id="measurement" class="mt-1 block w-full bg-gray-700 text-white py-2 px-3" value="{{ $measurement->measurement }}" required>
                    </div>

                    <div class="col-span-1">
                        <label for="date" class="block text-sm font-medium text-gray-300">Data</label>
                        <input type="date" name="date" id="date" class="mt-1 block w-full bg-gray-700 text-white py-2 px-3" value="{{ $measurement->date }}" required>
                    </div>
                </div>
                <div class="mt-8 text-right">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Zapisz</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
