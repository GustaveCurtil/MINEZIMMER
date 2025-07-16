
@extends('_layouts.head')

@section('scripts')
<script src="{{ asset('js/controls.js')}}"></script>
@endsection

@section('body')
<body>
    <header>
        @auth
        <p>Welgekomen, {{ $user->name }}</p>            
        <form action="{{ route('account.logout') }}" method="POST">
            @csrf
            <button type="submit">Uitloggen</button>
        </form>        
        @endauth
    </header>
    <aside>
        <section id="view">
            <div id="welkom">
                <p>Welkom G, </p>
                <p>Ik weet nog niet wat de bedoeling van deze website is, maar ik probeer het al bouwend vorm te geven snap je? Alsof ik niets beters heb te doen. <//3 Mopje ik vind dit gewoon leuk zeneu</p>
            </div>
            <div class="create">
                <form action="{{ route('room.create')}}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name">
                    <button type="submit">maak ruimte</button>
                </form>
            </div>
            <div class="create">
                <form action="{{ route('room.create')}}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name">
                    <button type="submit">maak tekst</button>
                </form>
            </div>
            <div class="create">
                <form action="{{ route('room.create')}}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name">
                    <button type="submit">maak foto</button>
                </form>
            </div>

            @foreach ($rooms as $room)
            <div class="room">
                <img src="{{ asset('icons/' . $room->icon_path)}}" alt="" srcset="">
                <h2>{{ $room->name }}</h2>                     
            </div>
            
            @endforeach
        </section>
        <section id="controls">
            Voeg toe: 
            <button>kamer</button>
            <button>tekst</button>
            <button>foto</button>
        </section>
    </aside>
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
</body>
@endsection