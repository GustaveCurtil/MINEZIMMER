@extends('_layouts.head')

@section('body')

<header>
    <div>
        <h1>
            MINEZIMMER 1.0
            <svg width="60" height="60" viewBox="0 0 60 60">
                <path d="M30 0L37.082 22.918H60L41.459 37.082L48.541 60L30 45.8359L11.459 60L18.541 37.082L0 22.918H22.918L30 0Z" fill="black"/>
            </svg>
        </h1>
    </div>
    @auth
        <form action="{{ route('account.logout') }}" method="POST">
        @csrf
        <button type="submit">{{ $user->name }} Uitloggen</button>
    </form> 
    @endauth
</header>
<main>
    <section id="content">
        @foreach ($rooms as $room)
        <p>
            <svg width="60" height="60" viewBox="0 0 60 60">
                <path d="M60 60H0V26L30 0L60 26V60Z" fill="white"/>
            </svg>
            <a href="{{ url('/' . $room->slug)}}">{{$room->name}}</a>
        </p>
        @endforeach
    </section>
</main>
<footer>
    <form action="{{ route('room.create')}}" method="POST">
        @csrf
        <input type="text" name="name" id="name">
        <button type="submit">maak Zimmer</button>
    </form>
</footer>

@endsection
