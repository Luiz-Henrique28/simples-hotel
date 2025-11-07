<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Tarefas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg">
                {{ session('success') }}
            </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="mb-4 flex justify-between items-center">
                        <a href="{{ route('tasks.create') }}"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 text-sm font-semibold shadow-lg transition-all duration-200">
                            + Cadastrar Nova Tarefa
                        </a>

                        <form action="{{ route('tasks.index') }}" method="GET" id="filter-form" class="flex items-center space-x-2">
                            <label for="status-filter" class="text-sm font-medium">Filtrar por Status: </label>

                            <select name="status" id="status-filter"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm"
                                onchange="document.getElementById('filter-form').submit()">

                                <option value="">Mostrar Todas</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendente</option>
                                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Feita</option>

                            </select>
                        </form>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Criado em</th>
                                <th class="px-6 py-3 bg-gray-50">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($tasks as $task)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $task->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $task->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $task->status === 'done' ? 'Concluída' : 'Pendente' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $task->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">

                                    <a href="{{ route('tasks.edit', $task) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                            @empty($tasks)
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">Nenhuma tarefa encontrada.</td>
                            </tr>
                            @endempty
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $tasks->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>