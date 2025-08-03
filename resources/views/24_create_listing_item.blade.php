@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('body')

<body>
    <header>
        <h1><a href="{{ route('home') }}">MINEZIMMER</a></h1>
        @if ($room)
        <a href="{{ str_replace('/bewerken', '', url()->current()) }}">terug</a>
        @else 
        <a href="{{ route('home') }}">terug</a>
        @endif
    </header> 
</body>
<main class="middle no-footer">
    <div>
        <section class="center">
                <form action="{{ route('listingitem.create') }}" method="POST">
                    @csrf

                    @error('name')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <input type="text" name="name" id="name" placeholder="naam" value="{{ old('name') }}">

                    @error('description')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <textarea name="description" id="description" placeholder="beschrijving">{{ old('description') }}</textarea>

                    <input type="hidden" name="listing_id" value="{{$listing->id}}">

                    <button type="submit">{{ $room ? 'Updaten' : 'Zimmerke machen' }}</button>
                </form>
        </section>
    </div>
</main>

@endsection
