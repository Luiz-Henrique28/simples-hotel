<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Tarefa: ' . $task->title) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Título da Tarefa')" />
                            <x-text-input
                                id="title"
                                name="title"
                                type="text"
                                class="mt-1 block w-full"

                                :value="old('title', $task->title)"
                                required
                                autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="description" :value="__('Descrição (Opcional)')" />
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('description', $task->description) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" required
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">

                                <option value="pending" @selected(old('status', $task->status) === 'pending')>Pendente</option>

                                <option value="done" @selected(old('status', $task->status) === 'done')>Concluída</option>
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('status')" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button class="ms-4">
                                {{ __('Salvar Alterações') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>