<x-app-layout>
    {{-- Cabeçalho da Página --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Meu Painel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Mensagem de Sucesso (para empréstimos ou devoluções) --}}
                    @if(session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600 bg-green-100 p-3 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Botão Principal de Ação --}}
                    <div class="mb-6">
                        <a href="{{ route('loans.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            + Pegar Novo Livro Emprestado
                        </a>
                    </div>
                    
                    <hr class="my-6">

                    {{-- Mini Relatório: Seus Livros Emprestados --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-3">Meus Livros Emprestados Atualmente</h3>
                        
                        {{-- Filtramos para mostrar apenas os livros que ainda não foram devolvidos --}}
                        @php
                            $activeLoans = $loans->where('returned', false);
                        @endphp

                        @if($activeLoans->isEmpty())
                            <p>Você não possui nenhum livro emprestado no momento.</p>
                        @else
                            <div class="overflow-x-auto border rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Título do Livro</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data do Empréstimo</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Data Limite para Devolução</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($activeLoans as $loan)
                                            <tr>
                                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $loan->book->titulo }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">{{ \Carbon\Carbon::parse($loan->loan_date)->format('d/m/Y') }}</td>
                                                <td class="px-6 py-4 text-sm text-gray-500">
                                                    {{-- Exemplo: Adiciona 15 dias à data de empréstimo --}}
                                                    {{ \Carbon\Carbon::parse($loan->loan_date)->addDays(15)->format('d/m/Y') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                    {{-- Formulário com o botão "Devolver" --}}
                                                    <form action="{{ route('loans.return', $loan->id) }}" method="POST">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="text-indigo-600 hover:text-indigo-900 font-semibold">Devolver</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>