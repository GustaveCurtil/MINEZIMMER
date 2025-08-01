@extends('_layouts.head')

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
        @if ($currentRoom === $room)
        <a href="{{ url('/' . $room->slug . '/bewerken') }}">kamer bewerken</a>
        @else
        <a href="{{ url('/' . $room->slug . '/' . $currentRoom->slug . '/' . $currentRoom->id . '/bewerken') }}">kamer bewerken</a>
        @endif
    </header>
    <main>
        <section id="tree">
            @if ($currentRoom !== $room)
            <div>
                <p>> <b><a href="{{ url('/' . $room->slug) }}">{{ $room->name }}</a></b>&nbsp;
                @foreach ($currentRoom->parents() as $parent)
                > <a href="{{ url('/' . $room->slug . '/' . $parent->slug) }}">{{ $parent->name }}</a>&nbsp;
                @endforeach
                > <b>{{ $currentRoom->name }}</b></p>
            </div>
            @else
            <p>> <b>{{ $room->name }}</b></p>
            @endif
        </section>

        <section id="description">
            <p>{!! nl2br(e($currentRoom->description ?? '')) !!}</p>
        </section>

        <section id="content">
            <div>
                @foreach ($subrooms as $subroom)
                <a href="{{ url('/' . $room->slug . '/' . $subroom->slug)}}"><span>@include('_partials.icon_house')</span>{{$subroom->name}}</a>
                @endforeach
            </div>
            
        </section>
    </main>
    <footer>
        @if (($currentRoom === $room))
        <a href="{{  url('/' . $room->slug . '/machen') }}"><button>+</button></a>
        @else
        <a href="{{  url('/' . $room->slug . '/' . $currentRoom->slug . '/' . $currentRoom->id . '/machen') }}"><button>+</button></a>
        @endif
    </footer>
</body>

@endsection