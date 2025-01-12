<x-app-layout title="Plany Suplementacyjne">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Lista planów suplementacyjnych.
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Nazwa</th>
                <th class="py-2 px-4 border-b">Klient</th>
                <th class="py-2 px-4 border-b">Stworzono</th>
                <th class="py-2 px-4 border-b">Akcje</th>
            </tr>
            </thead>
            <tbody>
            @foreach($supplementPlans as $plan)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $plan->name }}</td>
                    <td class="py-2 px-4 border-b">{{ $plan->customer->name ?? 'Brak' }}</td>
                    <td class="py-2 px-4 border-b">{{ $plan->created_at }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('supplement-plans.show', $plan->id) }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">Szczegóły</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
