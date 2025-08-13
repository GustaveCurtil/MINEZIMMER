@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('body')

<body>
    <header>
        <h1><a href="{{ route('home') }}">MINEZIMMER</a></h1>
        @if ($room)
        <a href="{{ str_replace('/bewerken', '', url()->current()) }}">zuruck</a>
        @else 
        <a href="{{ route('home') }}">zuruck</a>
        @endif
    </header> 
</body>
<main class="middle no-footer">
    <div>
        @if (!$room)
        <section  class="center">
            <h2><span>@include('_partials.icon_house')</span> Bestaande geschlossen Zimmmer</h2>
            <form action="{{ route('roommember.create') }}" method="POST">
                @csrf
                <fieldset>
                    @error('code')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <label for="code">Code</label>
                    <input type="text" name="code" id="code">
                </fieldset>    
                <button type="submit">Gehe nach Zimmer</button>
            </form>
        </section>
        <br>
        @endif
        <section class="center">
            @if (!$room)
            <h2><span class="icon" style="padding-right: 0">@include('_partials.icon_star')</span>/<span class="icon">@include('_partials.icon_house')</span>Zimmer machen</h2>
            <form action="{{ route('room.create') }}" method="POST">
            @else
            <h2>Zimmer Anpashen</h2>
            <form action="{{ route('room.update', $room) }}" method="POST" >                    
                @method('PUT')
            @endif 
                @csrf
                <fieldset>
                    @error('name')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <label for="name">Naam</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $room->name ?? '') }}" required>

                    @error('description')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <label for="description">Beschrijving</label>
                    <textarea name="description" id="description" placeholder="optioneel">{{ old('description', $room->description ?? '') }}</textarea>
                    {{-- <input type="hidden" name="write_read" value="0">
                    <label for="write-read"><input type="checkbox" name="write_read" id="write-read" value="1" {{ old('write_read', $room->write_read ?? 1) ? 'checked' : '' }}>anderen kunnen ook dingen toevoegen</label> --}}
                    <input type="hidden" name="open" value="0">
                    <label for="open"><input type="checkbox" name="open" id="open" value="1" {{ old('open', $room->open ?? 0) ? 'checked' : '' }}>openbare kamer</label>
                </fieldset>
                <button type="submit">{{ $room ? 'Updaten' : 'Zimmer machen' }}</button>
            </form>
        </section>
    </div>
</main>

@endsection
