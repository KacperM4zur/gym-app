<x-app-layout title="Szczegóły Planu Suplementacyjnego">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Szczegóły planu suplementacyjnego: {{ $supplementPlan->name }}
        </div>
        <a href="{{ route('supplement-plans.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Powrót do listy</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Dzień</th>
                <th class="py-2 px-4 border-b">Suplement</th>
                <th class="py-2 px-4 border-b">Ilość</th>
                <th class="py-2 px-4 border-b">Jednostka</th>
            </tr>
            </thead>
            <tbody>
            @foreach($supplementPlan->supplementPlanDays as $dayPlan)
                <tr>
                    <td colspan="4" class="bg-gray-800 text-white font-semibold py-2 px-4">{{ $dayPlan->day->name }}</td>
                </tr>
                @foreach($dayPlan->supplementDetails as $detail)
                    <tr>
                        <td class="py-2 px-4 border-b"></td>
                        <td class="py-2 px-4 border-b">{{ $detail->supplement->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $detail->amount ?? 'Brak' }}</td>
                        <td class="py-2 px-4 border-b">{{ $detail->unit ?? 'Brak' }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
