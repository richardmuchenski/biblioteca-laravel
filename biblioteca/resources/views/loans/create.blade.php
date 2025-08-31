<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pegar um Livro Emprestado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Livros Disponíveis no Acervo</h3>
                    
                    {{-- Change $books to $loans if you prefer, but be consistent --}}
                    @if($books->isEmpty())
                        <p>Não há livros disponíveis para empréstimo no momento.</p>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            {{-- CORRECTION IS HERE: from $loans as $loan TO $books as $book --}}
                            @foreach($books as $book)
                                <div class="border rounded-lg p-4 flex flex-col justify-between shadow">
                                    <div>
                                        @if($book->capa_url)
                                            <img src="{{ $book->capa_url }}" alt="Capa de {{ $book->titulo }}" class="w-full h-48 object-cover mb-4 rounded">
                                        @endif
                                        <h4 class="font-bold">{{ $book->titulo }}</h4>
                                        <p class="text-sm text-gray-600">{{ $book->autor }}</p>
                                        <p class="text-xs text-gray-500 mt-2">Estoque: {{ $book->quantidade_estoque }}</p>
                                    </div>
                                    
                                    <form action="{{ route('loans.store') }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="hidden" name="book_isbn" value="{{ $book->isbn }}">
                                        <button type="submit" class="w-full px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-500">
                                            Pegar Emprestado
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>