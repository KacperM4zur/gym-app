<x-app-layout title="Grupy ćwiczeń">
    <div class="flex justify-between items-center mb-4">
        <div class="text-white">
            Lorem Ipsum to po prostu fikcyjny tekst branży poligraficznej i składu.
        </div>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700" onclick="toggleForm(event)">
            Testowy
        </button>
    </div>
</x-app-layout>

<script>
    function toggleForm(event) {
        event.stopPropagation();
        document.getElementById('form-container').classList.toggle('hidden');
    }
</script>
