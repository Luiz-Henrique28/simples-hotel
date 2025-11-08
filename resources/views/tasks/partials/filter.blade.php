<form action="{{ route('tasks.index') }}" method="GET" id="filter-form" class="flex flex-col items-start gap-1">
    <label for="status-filter" class="text-sm font-medium">Filtrar por Status:</label>

    <select name="status" id="status-filter"
        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
        onchange="document.getElementById('filter-form').submit()">

        <option value="">Mostrar Todas</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendente</option>
        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Concluída</option>

    </select>
</form>