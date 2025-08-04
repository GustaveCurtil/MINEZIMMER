@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('body')
<body>
    <header>
        <h1>
            @if (!request()->routeIs('home'))
            <a href="{{ route('home') }}">MINEZIMMER</a>
            @else
            MINEZIMMER
            @endif
        </h1>
        @if ($update)
        <a href="{{ str_replace('/bewerken', '', url()->current()) }}">terug</a>
        @else
        <a href="{{ str_replace('zimmermachen', 'machen', url()->current()) }}">terug</a>
        @endif

    </header> 
    <main class="middle no-footer">
        <div>
            <section class="center">
                @if (!$update)
                    <form action="{{ route('listing.create') }}" method="POST">
                @else
                    <form action="{{ route('listing.update', $listing) }}" method="POST" >                    
                        @method('PUT')
                 @endif 
                        @csrf

                        @error('name')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <input type="text" name="name" id="name" placeholder="naam" value="{{ old('name', $update ? ($listing->name ?? '') : '') }}">

                        @error('description')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <textarea name="description" id="description" placeholder="beschrijving">{{ old('description', $update ? ($listing->description ?? '') : '') }}</textarea>
                    
                        {{-- <input type="hidden" name="with_description" value="0">
                        <label for="with-description"><input type="checkbox" name="with_description" id="with-description" value="1" {{ old('with_description', $room->with_description ?? 1) ? 'checked' : '' }}>anderen kunnen ook dingen toevoegen</label> --}}
                        {{-- <input type="hidden" name="with_weblink" value="0">
                        <label for="with-weblink"><input type="checkbox" name="with_weblink" id="with-weblink" value="1" {{ old('with_weblink', $room->with_weblink ?? 0) ? 'checked' : '' }}>publiek</label> --}}

                        <input type="hidden" name="room_id" value="{{$room->id}}">
                        <input type="hidden" name="subroom_id" value="{{ ($subroom->id ?? '')}}" >
                        
                        <button type="submit">{{ $update ? 'Updaten' : 'Liste machen' }}</button>
                    </form>
            </section>
        </div>
    </main>
</body>

@endsection
