@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Kanye Quotes') }}
                    </h2>
                    <ul class="mb-4">
                        @foreach($quotes as $quote)
                            <li class="mb-2">{{ $quote }}</li>
                        @endforeach
                    </ul>
                    <form action="{{ route('quotes.refresh') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">
                            Refresh Quotes
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection