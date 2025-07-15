
@extends('_layouts.head')

@section('scripts')
<script src="{{ asset('js/controls.js')}}"></script>
@endsection

@section('body')
<body>
    <header>
        @auth
        <p>{{ $user->name }}</p>
        @endauth
        <div>
            <form action="{{ route('room.create')}}" method="POST">
                @csrf
                <input type="text" name="name" id="name">
                <button type="submit">maak ruimte</button>
            </form>
            <form action="{{ route('account.logout') }}" method="POST">
                @csrf
                <button type="submit">Uitloggen</button>
            </form>
        </div>
    </header>
    <main>
        @foreach ($rooms as $room)
        <div class="weergave" style="color: {{ $room->color }}; background-color: {{ $room->bgColor }}">
            <img src="{{ asset('icons/' . $room->icon_path)}}" alt="" srcset="">
            <div>
                <a href="{{ url('/' . $room->id . '-' . $room->slug) }}" style="color: {{ $room->color }};">{{ $room->name }}</a>
            </div>
        </div>             
        @endforeach  
    </main> 
    <aside>
        @foreach ($rooms as $room)
        <div class="paneel" style="color: {{ $room->color }}; background-color: {{ $room->bgColor }}">
            <h2>{{ $room->name }}</h2>
            <form action="{{ route('room.editName')}}" method="POST">
                @csrf
                <input type="text" name="name" id="name" value="{{ $room->name }}">
                <button type="submit">maak ruimte</button>
            </form>
            <form action="{{ route('room.changeIcon') }}" method="post" id="iconSelector">
                @csrf
                <button type="submit">pictogram veranderen</button>
                <div>
                @foreach ($iconFiles as $file)
                    <label style="text-align: center;">
                        <input type="radio" name="icon_path" value="{{ $file->getRelativePathname() }}" required>
                        <img src="{{ asset('icons/' . $file->getRelativePathname()) }}" 
                                alt="{{ $file->getFilename() }}" 
                                class="icon">
                    </label>
                @endforeach
                </div>
                <input type="hidden" name="id" @if(isset($subroom)) value="{{ $subroom->id }}" @else value="{{ $room->id }}" @endif>   
            </form>
        </div>             
        @endforeach 
    </aside>
</body>
@endsection