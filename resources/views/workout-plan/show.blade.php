<x-app-layout title="Szczegóły Planu Treningowego">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Szczegóły planu treningowego: {{ $workoutPlan->name }}
        </div>
        <a href="{{ route('workout-plans.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">Powrót do listy</a>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">Dzień</th>
                <th class="py-2 px-4 border-b">Ćwiczenie</th>
                <th class="py-2 px-4 border-b">Waga</th>
                <th class="py-2 px-4 border-b">Powtórzenia</th>
                <th class="py-2 px-4 border-b">Serie</th>
                <th class="py-2 px-4 border-b">Czas</th>
            </tr>
            </thead>
            <tbody>
            @foreach($workoutPlan->workoutDays as $day)
                <tr>
                    <td colspan="6" class="bg-gray-800 text-white font-semibold py-2 px-4">{{ $day->day->name }}</td>
                </tr>
                @foreach($day->workoutExercises as $exercisePlan)
                    <tr>
                        <td class="py-2 px-4 border-b"></td>
                        <td class="py-2 px-4 border-b">{{ $exercisePlan->exercise->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $exercisePlan->weight ?? 'Brak' }}</td>
                        <td class="py-2 px-4 border-b">{{ $exercisePlan->reps ?? 'Brak' }}</td>
                        <td class="py-2 px-4 border-b">{{ $exercisePlan->sets ?? 'Brak' }}</td>
                        <td class="py-2 px-4 border-b">{{ $exercisePlan->brak ?? 'Brak' }}</td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>

