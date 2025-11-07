<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Nova Tarefa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">

                            <x-input-label for="title" :value="__('Título da Tarefa')" />
                            <x-text-input
                                id="title"
                                name="title"
                                type="text"
                                class="mt-1 block w-full"
                                :value="old('title')"
                                required
                                autofocus />

                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label for="description" :value="__('Descrição (Opcional)')" />
                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">{{ old('description') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('description')" />
                        </div>

                        <div class="flex items-center justify-end">
                            <x-primary-button class="ms-4">
                                {{ __('Salvar Tarefa') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>