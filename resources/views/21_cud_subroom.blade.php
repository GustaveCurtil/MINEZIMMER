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
        <a href="{{ str_replace('/' . $subroom->id . '/bewerken', '', url()->current()) }}">terug</a>
        @elseif ($subroom)
        <a href="{{ str_replace('/' . $subroom->id . '/machen', '', url()->current()) }}">terug</a>
        @else
        <a href="{{ str_replace('/machen', '', url()->current()) }}">terug</a>
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

                        @error('name')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <input type="text" name="name" id="name" placeholder="naam" value="{{ old('name', $update ? ($subroom->name ?? '') : '') }}">

                        @error('description')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <textarea name="description" id="description" placeholder="beschrijving">{{ old('description', $update ? ($subroom->description ?? '') : '') }}</textarea>
                    
                        <input type="hidden" name="room_id" value="{{$room->id}}">
                        <input type="hidden" name="subroom_id" value="{{ ($subroom->id ?? '')}}" >
                        
                        <button type="submit">{{ $update ? 'Updaten' : 'Zimmerke machen' }}</button>
                    </form>
            </section>
        </div>
    </main>
</body>

@endsection
