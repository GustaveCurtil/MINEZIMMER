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
    </header>
    <main>
        <section id="tree">
            <div>
                <p>> <b><a href="{{ url('/' . $listing->room->id) }}">{{ $listing->room->name }}</a></b>&nbsp;
                @if ($listing->subroom_id)
                @foreach ($listing->subroom->parents() as $parent)
                > <a href="{{ url('/' . $listing->room->id . '/s-' . $parent->id) }}">{{ $parent->name }}</a>&nbsp;
                @endforeach
                > <a href="{{ url('/' . $listing->room->id . '/s-' . $listing->subroom->id) }}">{{ $listing->subroom->name }}</a> 
                @endif
                > <b>{{ $listing->name }}</b></p>
            </div>
        </section>

        <section id="description">
            <p>{!! nl2br(e($currentRoom->description ?? '')) !!}</p>
        </section>

        <section id="content">
            <div>
                <ul>
                    @foreach ($listingItems as $listingItem)
                    <li>{{$listingItem->name}}</li>
                    @endforeach
                </ul>
                
            </div>
        </section>
    </main>
    <footer>
        <a href="{{  url('/' . $listing->room->id . '/l-' . $listing->id . '/zufugen') }}"><button>+</button></a>
    </footer>
</body>

@endsection