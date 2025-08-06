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
        @auth
        <a href="{{ route('settings') }}">{{$user->name}}</a>
        @endauth
    </header>
    <main>
        @if ($rooms)
        <section id="content">
            <div>
                @foreach ($rooms as $room)  
                <a href="{{ url('/' . $room->id)}}">
                    @if ($room->open)
                    <span class="icon">@include('_partials.icon_star')</span>
                    @else
                    <span class="icon">@include('_partials.icon_house')</span>
                    @endif
                    {{$room->name}}</a> 
                @endforeach
            </div>
            
        </section>
        @endif
    </main>
    <footer>
        <a href="{{  url('/zimmermachen') }}"><button>+</button></a>
    </footer>
</body>

@endsection
