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
        @if ($currentRoom->user->id === $user->id)
        @if ($currentRoom === $room)
        <a href="{{ url('/' . $room->id . '/bewerken') }}">kamer bewerken</a>
        @else
        <a href="{{ url('/' . $room->id . '/s-' . $currentRoom->id . '/bewerken') }}">kamer bewerken</a>
        @endif
        @endif
    </header>
    <main>
        <section id="tree">
            @if ($currentRoom !== $room)
            <div>
                <p>> <b><a href="{{ url('/' . $room->id) }}">{{ $room->name }}</a></b>&nbsp;
                @foreach ($currentRoom->parents() as $parent)
                > <a href="{{ url('/' . $room->id . '/s-' . $parent->id) }}">{{ $parent->name }}</a>&nbsp;
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
                <a href="{{ url('/' . $room->id . '/s-' . $subroom->id)}}"><span>@include('_partials.icon_room')</span>{{$subroom->name}}</a>
                @endforeach
                @foreach ($listings as $listing)
                <a href="{{ url('/' . $room->id . '/l-' . $listing->id)}}"><span>@include('_partials.icon_listing')</span>{{$listing->name}}</a>
                @endforeach
            </div>
            
        </section>
    </main>
    <footer>
        @if (($currentRoom === $room))
        <a href="{{  url('/' . $room->id . '/machen') }}"><button>+</button></a>
        @else
        <a href="{{  url('/' . $room->id . '/s-' . $currentRoom->id . '/machen') }}"><button>+</button></a>
        @endif
    </footer>
</body>

@endsection