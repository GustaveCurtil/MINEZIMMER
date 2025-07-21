@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('main')

<main>
    <section id="tree">
        @if ($currentRoom !== $room)
        <div>
            <p><b><a href="{{ url('/' . $room->slug) }}">{{ $room->name }}</a></b></p>
            @foreach ($currentRoom->parents() as $parent)
            <p>&nbsp;> <a href="{{ url('/' . $room->slug . '/' . $parent->slug) }}">{{ $parent->name }}</a></p>
            @endforeach
            <p>&nbsp;> {{ $currentRoom->name }}</p>
        </div>
        @else
        <p><b>{{ $room->name }}</b></p>
        @endif
    </section>

    <section id="description">
        <form method="post" class="seeming" action="{{ route('subroom.description') }}">
            @csrf
            <textarea name="description" id="description" placeholder="Voeg beschrijving toe">{{ $currentRoom->description ?? '' }}</textarea>
            <input type="hidden" name="room_id" value="{{ $room->id }}">
            @if (($currentRoom !== $room))
            <input type="hidden" name="subroom_id" value="{{ $currentRoom->id }}">
            @endif
            <button type="submit" class="hide">beschrijving opslaan</button>
        </form>
    </section>

    <section id="content">
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
    <a href="{{  url('/etwas-machen') }}"><button>Etwas machen</button></a>
</footer>

@endsection