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
        <a href="{{ str_replace('listemachen', 'machen', url()->current()) }}">terug</a>
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
                        <h3>Lijst</h3>
                        <fieldset>
                            @error('name')
                            <p>⚠️ {{$message}}</p>
                            @enderror
                            <label for="name">Naam</label>
                            <input type="text" name="name" id="name" placeholder="naam" value="{{ old('name', $update ? ($listing->name ?? '') : '') }}">

                            @error('description')
                            <p>⚠️ {{$message}}</p>
                            @enderror
                            <label for="description">Beschrijving</label>
                            <textarea name="description" id="description" placeholder="beschrijving">{{ old('description', $update ? ($listing->description ?? '') : '') }}</textarea>
                        </fieldset>
                        <h3>Lijst-item</h3>
                        <fieldset>
                            <label for="title_label">Label voor titel</label>
                            <input type="text" name="title_label" id="titel-label" maxlength="60" placeholder="bv. album, boek, ingrediënt, optie, ..." value="{{ old('title_label', $update ? ($listing->title_label ?? '') : '') }}">                    

                            <input type="hidden" name="with_subtitle" value="0">
                            <label for="with-subtitle"><input type="checkbox" name="with_subtitle" id="with-subtitle" value="1" {{ old('with_subtitle', $listing->with_subtitle ?? 0) ? 'checked' : '' }}>subtitel toevoegen</label>
                            <label for="subtitle_label" class="sub">Label voor subtitel</label>
                            <input type="text" class="sub" name="subtitle_label" id="subtitle-label" placeholder="bv. artiest, auteur, kok, ..." value="{{ old('subtitle_label', $update ? ($listing->subtitle_label ?? '') : '') }}">
                            {{-- <input type="hidden" name="with_description" value="0">
                            <label for="with-description"><input type="checkbox" name="with_description" id="with-description" value="1" {{ old('with_description', $listing->with_description ?? 1) ? 'checked' : '' }}>beschrijving toevoegen aan items</label>
                            <input type="hidden" name="with_weblink" value="0">
                            <label for="with-weblink"><input type="checkbox" name="with_weblink" id="with-weblink" value="1" {{ old('with_weblink', $listing->with_weblink ?? 0) ? 'checked' : '' }}>weblink toevoegen aan items</label>  --}}
                        </fieldset>
                        <input type="hidden" name="room_id" value="{{$room->id}}">
                        <input type="hidden" name="subroom_id" value="{{ ($subroom->id ?? '')}}" >
                        <br>
                        <button type="submit">{{ $update ? 'Updaten' : 'Liste machen' }}</button>
                    </form>
            </section>
        </div>
    </main>
</body>

@endsection
