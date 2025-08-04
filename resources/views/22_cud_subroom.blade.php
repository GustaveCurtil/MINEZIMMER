@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('body')
<body>
    <header>
        <h1>
            @if (!request()->routeIs('home'))
            <a href="{{ route('home') }}">MINEZIMMER</a>
            @else
            MINEZIMMER
            @endif
        </h1>
        @if ($update)
        <a href="{{ str_replace('/bewerken', '', url()->current()) }}">terug</a>
        @else
        <a href="{{ str_replace('zimmermachen', 'machen', url()->current()) }}">terug</a>
        @endif

    </header> 
    <main class="middle no-footer">
        <div>
            <section class="center">
                @if (!$update)
                    <form action="{{ route('subroom.create') }}" method="POST">
                @else
                    <form action="{{ route('subroom.update', $subroom) }}" method="POST" >                    
                        @method('PUT')
                 @endif 
                        @csrf
                        <fieldset>
                            @error('name')
                            <p>⚠️ {{$message}}</p>
                            @enderror
                            <label for="name">Naam</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $update ? ($subroom->name ?? '') : '') }}">

                            @error('description')
                            <p>⚠️ {{$message}}</p>
                            @enderror
                            <label for="description">Beschrijving</label>
                            <textarea name="description" id="description">{{ old('description', $update ? ($subroom->description ?? '') : '') }}</textarea>
                        
                            <input type="hidden" name="room_id" value="{{$room->id}}">
                            <input type="hidden" name="subroom_id" value="{{ ($subroom->id ?? '')}}" >
                        </fieldset>
                        <button type="submit">{{ $update ? 'Updaten' : 'Zimmerke machen' }}</button>
                    </form>
            </section>
        </div>
    </main>
</body>

@endsection
