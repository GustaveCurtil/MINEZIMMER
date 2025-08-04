@extends('_layouts.head')

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
        @if ($listing->user->id === $user->id)
         <a href="{{ url('/' . $listing->room->id . '/l-' . $listing->id . '/bewerken') }}">lijst bewerken</a>
        @endif
    </header>
    <main>
        <section id="tree">
            <div>
                <p>> <b><a href="{{ url('/' . $listing->room->id) }}">{{ $listing->room->name }}</a></b>
                @if ($listing->subroom_id)
                @foreach ($listing->subroom->parents() as $parent)
                > <a href="{{ url('/' . $listing->room->id . '/s-' . $parent->id) }}">{{ $parent->name }}</a>&nbsp;
                @endforeach
                > <a href="{{ url('/' . $listing->room->id . '/s-' . $listing->subroom->id) }}">{{ $listing->subroom->name }}</a> 
                @endif
                > <span class='svg'>@include('_partials.icon_listing')</span><b>{{ $listing->name }}</b></p>
            </div>
        </section>

        <section id="description">
            <p>{!! nl2br(e($listing->description ?? '')) !!}</p>
        </section>

        <section id="content">
            <div>
                <ul>
                    @foreach ($listingItems as $listingItem)
                    @if ($listingItem->description || $listingItem->weblink || $listing->with_subtitle && $listingItem->subtitle)
                    <details>
                        <summary><span class="list-item">{{$listingItem->title}}</span></summary>
                        @if ($listing->with_subtitle && $listingItem->subtitle)
                        <p>{{$listing->subtitle_label}}: {{$listingItem->subtitle}}</p>
                        @endif
                        @if ($listingItem->description)
                        <p>beschrijving: {{$listingItem->description}}</p>
                        @endif
                        @if ($listingItem->weblink)
                        <p><a href="{{$listingItem->weblink}}" target="_blank">weblink</a></p>
                        @endif
                    </details>
                    @else
                    <p>- {{$listingItem->name}}</p>
                    @endif
                    @endforeach
                </ul>
                
            </div>
        </section>
    </main>
    <footer>
        <a href="{{  url('/' . $listing->room->id . '/l-' . $listing->id . '/zufugen') }}"><button>+</button></a>
    </footer>
</body>

@endsection