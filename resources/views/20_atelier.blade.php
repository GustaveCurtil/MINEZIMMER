@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('body')

<body>
    <header>
        <h1><a href="{{ route('home') }}">MINEZIMMER</a></h1>
        @if ($room)
        <a href="{{ str_replace('/machen', '', url()->current()) }}">zuruck</a>
        @else 
        <a href="{{ route('home') }}">zuruck</a>
        @endif
    </header> 
</body>
<main class="middle no-footer">
    <div>
        <section class="center" id="content">
            <div>
                @if (!$subroom)
                <a href="{{  url('/' . $room->id . '/zimmermachen') }}"><span class="icon">@include('_partials.icon_room')</span>zimmer machen</a>
                <a href="{{  url('/' . $room->id . '/listemachen') }}"><span class="icon">@include('_partials.icon_listing')</span>lijst machen</a>
                @else
                <a href="{{  url('/' . $room->id . '/s-' . $subroom->id . '/zimmermachen') }}"><span class="icon">@include('_partials.icon_room')</span>zimmer machen</a>
                <a href="{{  url('/' . $room->id . '/s-' . $subroom->id . '/listemachen') }}"><span class="icon">@include('_partials.icon_listing')</span>lijst machen</a>
                @endif
            </div>
            
        </section>
    </div>
</main>

@endsection
