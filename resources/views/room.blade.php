@extends('_layouts.head')

@section('body')

<header>
    <div>
        <h1>
            <a href="{{ url('/') }}">MINEZIMMER 1.0</a>
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
    <section id="tree">
        @if ($currentRoom !== $room)
        <p><b><a href="{{ url('/' . $room->slug) }}">{{ $room->name }}</a></b></p>
        <div>
            @foreach ($currentRoom->parents() as $parent)
                <p>&nbsp;> <a href="{{ url('/' . $room->slug . '/' . $parent->slug) }}">{{ $parent->name }}</a></p>
            @endforeach
            <p>&nbsp;> {{ $currentRoom->name }}:</p>
        </div>
        @else
        <p><b>{{ $room->name }}:</b></p>
        @endif
    </section>

    @if ($currentRoom->description)
    <section id="description">
        @if(isset($currentRoom->id) && $currentRoom->user->id === $user->id)
        <form method="post">
            <textarea name="description" id="description">
                {{ $currentRoom->description }}
            </textarea>
            <button type="submit">beschrijving opslaan</button>
        </form>
        @else
        <p>
        {{ $currentRoom->description }}
        </p>
        @endif
    </section>
    @endif

    <section id="content">
        <p>Zimmerkes:</p>
        <div>
            @foreach ($subrooms as $subroom)
            <div>
                <svg width="60" height="60" viewBox="0 0 60 60">
                    <path d="M60 60H0V26L30 0L60 26V60Z" fill="white"/>
                </svg>
                <a href="{{ url('/' . $room->slug . '/' . $subroom->slug)}}">{{$subroom->name}}</a>
            </div>
            @endforeach
        </div>
        
    </section>
</main>
<footer>
    <form action="{{ route('subroom.create')}}" method="POST">
        @csrf
        <input type="text" name="name" id="name">
        <input type="hidden" name="level" @if($currentRoom !== $room) value="{{ $currentRoom->level + 1 }}" @else value="1" @endif>
        <input type="hidden" name="room_id" value="{{ $room->id }}" >
        <input type="hidden" name="subroom_id" @if($currentRoom !== $room) value="{{ $currentRoom->id }}" @endif >
        <button type="submit">maak zimmerke</button>
    </form>
</footer>

@endsection