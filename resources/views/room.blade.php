<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <title>{{ $room->name }}</title>
</head>
<body>
    <header>
        <h1>Muziekkamers</h1>
        <h2>{{ $room->name }}
        @if (isset($subroom))   
        @for ($i = 1; $i < count($subroom->allParents()); $i++)
            > {{ $subroom->allParents()[$i]->name }}
        @endfor
        > {{ $subroom->name }}
        @endif
        </h2>
            <form action="{{ route('room.create')}}" method="POST">
                @csrf
                <input type="text" name="name" id="name" placeholder="binnenkamer">
                <input type="hidden" name="level" @if(isset($subroom)) value="{{ $subroom->level + 1 }}" @else value="1" @endif>
                <input type="hidden" name="upper_room" @if(isset($subroom)) value="{{ $subroom->id }}" @else value="{{ $room->id }}" @endif >
                <button type="submit">maak kamer</button>
            </form>
        @if (!isset($subroom))
        <a href="{{ url('/') }}">terug</a>
        @elseif ($subroom->level === 1)
        <a href="{{ url('/' . $room->id . '-' . $room->name) }}">terug</a>
        @else
        <a href="{{ url('/' . $room->id . '-' . $room->name . '/' . $subroom->parent->id . '-' . $subroom->parent->name) }}">terug</a>
        @endif
    </header>
    <main>
        <section>
            <h3>Kamers</h3>
            @foreach ($subrooms as $subroom)
            <a href="{{ url('/' . $room->id . '-' . $room->name . '/' . $subroom->id . '-' . $subroom->name) }}">{{ $subroom->name }}</a>            
            @endforeach  
        </section>
        {{-- <section id="collectie">
            @for ($i = 1; $i < 51; $i++)
            <img src="{{ asset('albumcovers/album' . $i . '.jpg') }}" alt="Album {{ $i }}">
            @endfor
        </section>
        <section id="informatie">
            @for ($i = 1; $i < 51; $i++)
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum magni libero cum odio possimus eius praesentium aliquid accusantium reiciendis minus molestiae vitae eum, quidem quibusdam neque laboriosam id non amet?</p>
            @endfor
        </section> --}}
    </main>
</body>
</html>