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
                @if (!$room)
                <form action="{{ route('room.create') }}" method="POST">
                @else
                <form action="{{ route('room.update', $room) }}" method="POST" >                    
                    @method('PUT')
                @endif 
                    @csrf

                    @error('name')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <input type="text" name="name" id="name" placeholder="naam" value="{{ old('name', $room->name ?? '') }}">

                    @error('description')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <textarea name="description" id="description" placeholder="beschrijving">{{ old('description', $room->description ?? '') }}</textarea>
                    <input type="hidden" name="write_read" value="0">
                    <label for="write-read"><input type="checkbox" name="write_read" id="write-read" value="1" {{ old('write_read', $room->write_read ?? 1) ? 'checked' : '' }}>anderen kunnen ook dingen toevoegen</label>
                    <input type="hidden" name="open" value="0">
                    <label for="open"><input type="checkbox" name="open" id="open" value="1" {{ old('open', $room->open ?? 0) ? 'checked' : '' }}>publiek</label>
                    <button type="submit">{{ $room ? 'Updaten' : 'Zimmerke machen' }}</button>
                </form>
        </section>
    </div>
</main>

@endsection
