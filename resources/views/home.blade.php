
@extends('_layouts.head')
    
@section('main')
    @foreach ($rooms as $room)
    <div class="weergave" style="color: {{ $room->color }}; background-color: {{ $room->bgColor }}">
        <div>
            <img src="{{asset('/icons/0-B/BUTTERF2.ICO')}}" alt="" srcset="">
        </div>
        <a href="{{ url('/' . $room->id . '-' . $room->name) }}" style="color: {{ $room->color }};">{{ $room->name }}</a>
        <p>{{ $room->children->count() }} kamer(s)</p>
    </div>             
    @endforeach  
    <div id="icons">
    @foreach ($iconFiles as $file)
        <img src="{{ asset('icons/' . $file->getRelativePathname()) }}" alt="{{ $file->getFilename() }}">
    @endforeach
    </div>
@endsection

@section('control-panel')
    <form action="{{ route('room.create')}}" method="POST">
        @csrf
        <input type="text" name="name" id="name">
        <input type="hidden" name="level" value="0">
        <input type="hidden" name="upper_room">
        <button type="submit">maak ruimte</button>
    </form>
    <form action="{{ route('account.logout') }}" method="POST">
        @csrf
        <button type="submit">Uitloggen</button>
    </form>
@endsection