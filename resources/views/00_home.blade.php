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
        <section id="content">
            <div>
                @foreach ($rooms as $room)
                <div>    
                    <a href="{{ url('/' . $room->slug)}}">
                        <span>
                            <svg width="60" height="60" viewBox="0 0 60 60">
                            <path d="M60 60H0V26L30 0L60 26V60Z" fill="white"/>
                            </svg></span>{{$room->name}}
                    </a> 
                </div>
                @endforeach
            </div>
            
        </section>
    </main>
    <footer>
        <a href="{{  url('/machen') }}"><button>Zimmer machen</button></a>
    </footer>
</body>

@endsection
