
@extends('_layouts.head')

@section('scripts')
<script src="{{ asset('js/controls.js')}}"></script>
@endsection

@section('body')
<body>
    <header>
        @auth
        <div>
            <p><a href="{{ url('/')}}">{{ $user->name }}</a> > <a href="{{ url('/' . $actualRoom->id . '-' . $actualRoom->slug) }}">{{ $actualRoom->name }}</a>
            @if (isset($actualSubroom) && $actualRoom !== $actualSubroom)   
            @for ($i = 0; $i < count($actualSubroom->parents()); $i++)
            &nbsp;> <a href="{{ url('/' . $actualRoom->id . '-' . $actualRoom->slug . '/' . $actualSubroom->parents()[$i]->id . '-' . $actualSubroom->parents()[$i]->slug) }}">{{ $actualSubroom->parents()[$i]->name }}</a>
            @endfor
            &nbsp;> {{ $actualSubroom->name }}
            </p>
            <form action="{{ route('account.logout') }}" method="POST">
                @csrf
                <button type="submit">Uitloggen</button>
            </form>
        </div>
        @endif
        @endauth
    </header>
    <main>
        <form action="{{ route('subroom.create')}}" method="POST">
            @csrf
            <input type="text" name="name" id="name">
            <input type="hidden" name="level" @if(isset($actualSubroom)) value="{{ $actualSubroom->level + 1 }}" @else value="1" @endif>
            <input type="hidden" name="room_id" value="{{ $actualRoom->id }}" >
            <input type="hidden" name="subroom_id" @if(isset($actualSubroom)) value="{{ $actualSubroom->id }}" @endif >
            <button type="submit">maak ruimte</button>
        </form>
        @foreach ($children as $child)
        <div class="weergave" style="color: {{ $child->color }}; background-color: {{ $child->bgColor }}">
            <img src="{{ asset('icons/' . $child->icon_path)}}" alt="" srcset="">
            <div>
                <a href="{{ url('/' . $actualRoom->id . '-' . $actualRoom->slug . '/' . $child->id . '-' . $child->slug) }}" style="color: {{ $child->color }};">{{ $child->name }}</a>
            </div>
        </div>             
        @endforeach  
    </main> 
    <aside>
        <h2>{{ $actualSubroom->name }}</h2>
        <form action="{{ route('room.editName')}}" method="POST">
            @csrf
            <input type="text" name="name" id="name" value="{{ $actualSubroom->name }}">
            <button type="submit">maak ruimte</button>
        </form>
        <form @if(isset($actualSubroom)) action="{{ route('subroom.changeIcon') }}" @else action="{{ route('room.changeIcon') }}" @endif method="post" id="iconSelector">
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
            <input type="hidden" name="id" @if(isset($actualSubroom)) value="{{ $actualSubroom->id }}" @else value="{{ $room->id }}" @endif>   
        </form>          
    </aside>
</body>
@endsection