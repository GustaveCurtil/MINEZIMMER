@extends('_layouts.head')

@section('main')

<main>
    <section id="content">
        <div>
            @foreach ($rooms as $room)
            <div>
                <svg width="60" height="60" viewBox="0 0 60 60">
                    <path d="M60 60H0V26L30 0L60 26V60Z" fill="white"/>
                </svg>
                <a href="{{ url('/' . $room->slug)}}">{{$room->name}}</a> 
                <span>door {{$room->user->name}}</span>
            </div>
            @endforeach
        </div>
        
    </section>
</main>
<footer>
    <form action="{{ route('room.create')}}" method="POST" class="one-liner">
        @csrf
        <input type="text" name="name" id="name">
        <button type="submit">maak Zimmer</button>
    </form>
</footer>

@endsection
