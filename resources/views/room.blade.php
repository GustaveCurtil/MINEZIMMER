@extends('_layouts.head')

@section('color')
@if (isset($subroom)) 
{{ $subroom->color }}
@else
{{ $room->color }}
@endif
@endsection

@section('bgColor')
@if (isset($subroom)) 
{{ $subroom->bgColor }}
@else
{{ $room->bgColor }}
@endif
@endsection

@section('main')
<section id="tree-structure">
    <h2><img src="{{asset('/icons/' . $room->icon_path)}}" alt="" srcset=""> {{ $room->name }}</h2>
    @if (isset($subroom))   
    <p>
    @for ($i = 1; $i < count($subroom->allParents()); $i++)
       &nbsp;> <img src="{{asset('/icons/' . $subroom->allParents()[$i]->icon_path)}}" alt=""> {{ $subroom->allParents()[$i]->name }}
    @endfor
    &nbsp;> <img src="{{asset('/icons/' . $subroom->icon_path)}}" alt="" srcset=""> {{ $subroom->name }}
    </p>
    @endif
</section>
<section>
    @foreach ($subrooms as $item)
    <div class="weergave" style="color: {{ $item->color }}; background-color: {{ $item->bgColor }}">
        <div>
            <img src="{{asset('/icons/' . $item->icon_path)}}" alt="" srcset="">
        </div>
        <a  href="{{ url('/' . $room->id . '-' . $room->slug . '/' . $item->id . '-' . $item->slug) }}" style="color: {{ $item->color }};">{{ $item->name }}</a> 
        <p>{{ $item->children->count() }} kamer(s)</p>
    </div>           
    @endforeach      
</section>
@endsection

@section('control-panel')
    @if (!isset($subroom))
    <a href="{{ url('/') }}">terug</a>
    @elseif ($subroom->level === 1)
    <a href="{{ url('/' . $room->id . '-' . $room->slug) }}">terug</a>
    @else
    <a href="{{ url('/' . $room->id . '-' . $room->slug . '/' . $subroom->parent->id . '-' . $subroom->parent->slug) }}">terug</a>
    @endif
    <form action="{{ route('room.create')}}" method="POST">
        @csrf
        <input type="text" name="name" id="name" placeholder="binnenkamer">
        <input type="hidden" name="level" @if(isset($subroom)) value="{{ $subroom->level + 1 }}" @else value="1" @endif>
        <input type="hidden" name="upper_room" @if(isset($subroom)) value="{{ $subroom->id }}" @else value="{{ $room->id }}" @endif >
        <button type="submit">maak kamer</button>
    </form>
    <form action="{{ route('room.customizeColor') }}" method="post">
        @csrf
        <input type="color" name="color" id="color"  @if(isset($subroom)) value="{{ $subroom->color }}" @else value="{{ $room->color }}" @endif>
        <input type="color" name="bgColor" id="bgColor"  @if(isset($subroom)) value="{{ $subroom->bgColor }}" @else value="{{ $room->bgColor }}" @endif>
        <input type="hidden" name="id" @if(isset($subroom)) value="{{ $subroom->id }}" @else value="{{ $room->id }}" @endif>
        <button type="submit">kleur aanpassen</button>
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
@endsection