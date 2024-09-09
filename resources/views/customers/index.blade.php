<x-app-layout title="Klienci">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Informacje o klientach.
        </div>
        <a href="{{ route('customers.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
            Stwórz
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nazwa</th>
                <th class="py-2 px-4 border-b">Email</th>
                <th class="py-2 px-4 border-b">Zweryfikowany email</th>
                <th class="py-2 px-4 border-b">Role</th>
                <th class="py-2 px-4 border-b">Stworzono</th>
                <th class="py-2 px-4 border-b">Zaktualizowano</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $customer->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->email }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->email_verified_at ? 'Tak' : 'Nie' }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->role->name ?? 'Not set' }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->created_at }}</td>
                    <td class="py-2 px-4 border-b">{{ $customer->updated_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <div class="flex flex-col sm:flex-row sm:space-x-2 space-y-4 sm:space-y-0">
                            <a href="{{ route('customers.edit', ['id' => $customer->id]) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-700">Edycja</a>
                            <form action="{{ route('customers.delete', ['id' => $customer->id]) }}" method="POST" style="display:inline;">
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
