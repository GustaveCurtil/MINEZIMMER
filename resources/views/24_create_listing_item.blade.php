@extends('_layouts.head')

@section('scripts')
<script src="{{asset('js/textarea.js')}}" defer></script>
@endsection

@section('body')

<body>
    <header>
        <h1><a href="{{ route('home') }}">MINEZIMMER</a></h1>
        <a href="{{ str_replace('/zufugen', '', url()->current()) }}">terug</a>
    </header> 
</body>
<main class="middle no-footer">
    <div>
        <section class="center">
                <form action="{{ route('listingitem.create') }}" method="POST">
                    @csrf
                    <h3>Item zufugen</h3>
                    <fieldset>
                        @error("title")
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <label for="title">{{$listing->title_label}}*</label>
                        <input type="text" name="title" id="title" placeholder="{{$listing->title_label}}" value="{{ old("title") }}">

                        @if ($listing->with_subtitle)
                        @error("subtitle")
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <label for="subtitle">{{$listing->subtitle_label}}</label>
                        <input type="text" name="subtitle" id="subtitle" placeholder="{{$listing->subtitle_label}}" value="{{ old("subtitle") }}">
                        @endif
                        
                        @error('description')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <label for="description">Beschrijving</label>
                        <textarea name="description" id="description" placeholder="beschrijving">{{ old('description') }}</textarea>

                        @error('weblink')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <label for="weblink">url</label>
                        <input type="text" name="weblink" id="weblink" placeholder="url" value="{{ old('weblink') }}">

                        <input type="hidden" name="listing_id" value="{{$listing->id}}">
                    </fieldset>

                    <button type="submit">{{ $update ? 'Updaten' : 'item machen' }}</button>
                </form>
        </section>
    </div>
</main>

@endsection
