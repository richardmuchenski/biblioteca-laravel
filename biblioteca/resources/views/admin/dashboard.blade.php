<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Painel do Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ferramentas de Gerenciamento</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        <!-- Gerenciar Livros -->
                        <a href="{{ route('books.index') }}" class="block p-6 bg-gray-100 hover:bg-gray-200 rounded-lg">
                            <h4 class="font-bold text-lg">Gerenciar Acervo</h4>
                            <p class="text-sm text-gray-600">Adicionar, editar e excluir livros.</p>
                        </a>

                        <!-- Gerenciar Usuários -->
                        <a href="{{ route('users.index') }}" class="block p-6 bg-gray-100 hover:bg-gray-200 rounded-lg">
                            <h4 class="font-bold text-lg">Gerenciar Usuários</h4>
                            <p class="text-sm text-gray-600">Editar e excluir usuários existentes.</p>
                        </a>

                        <!-- Relatórios (funcionalidade futura) -->
                        <a href="#" class="block p-6 bg-gray-100 hover:bg-gray-200 rounded-lg">
                            <h4 class="font-bold text-lg">Relatórios</h4>
                            <p class="text-sm text-gray-600">Visualizar relatórios de empréstimos.</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>