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
                <p>> <b><a href="{{ url('/' . $room->slug) }}">{{ $room->name }}</a></b>&nbsp;</p>
                @foreach ($currentRoom->parents() as $parent)
                <p>> <a href="{{ url('/' . $room->slug . '/' . $parent->slug) }}">{{ $parent->name }}</a>&nbsp;</p>
                @endforeach
                <p>> <b>{{ $currentRoom->name }}</b></p>
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
                <div>
                    <a href="{{ url('/' . $room->slug . '/' . $subroom->slug)}}">
                        <span><svg width="60" height="60" viewBox="0 0 60 60"><path d="M60 60H0V26L30 0L60 26V60Z" fill="white"/></svg></span>{{$subroom->name}}
                    </a>
                </div>
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