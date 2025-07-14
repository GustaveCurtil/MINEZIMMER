
@extends('_layouts.head')

@section('scripts')
<script src="{{ asset('js/controls.js')}}"></script>
@endsection

@section('body')
<body>
    <header>
        <div>
            <form action="{{ route('room.create')}}" method="POST">
                @csrf
                <input type="text" name="name" id="name">
                <button type="submit">maak ruimte</button>
            </form>
            <button>selecteer</button>
            <button>editeer</button>
        </div>
        <form action="{{ route('account.logout') }}" method="POST">
            @csrf
            <button type="submit">Uitloggen</button>
        </form>
    </header>
    <main>
        @foreach ($rooms as $room)
        <div class="weergave" style="color: {{ $room->color }}; background-color: {{ $room->bgColor }}">
            <img src="{{asset('/icons/0-B/BUTTERF2.ICO')}}" alt="" srcset="">
            <div>
                <a href="{{ url('/' . $room->id . '-' . $room->name) }}" style="color: {{ $room->color }};">{{ $room->name }}</a>
            </div>
        </div>             
        @endforeach  
    </main> 
    <aside>
        @foreach ($rooms as $room)
        <div class="paneel" style="color: {{ $room->color }}; background-color: {{ $room->bgColor }}">
            <img src="{{asset('/icons/0-B/BUTTERF2.ICO')}}" alt="" srcset="">
            <div>
                <a href="{{ url('/' . $room->id . '-' . $room->name) }}" style="color: {{ $room->color }};">{{ $room->name }}</a>
            </div>
        </div>             
        @endforeach 
    </aside>
</body>
@endsection