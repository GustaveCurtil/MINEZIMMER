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
        <p>{{ $user->name }}</p>
    </header>
    <main>
        <section class="center">
            <form action="{{ route('account.logout') }}" method="POST">
                @csrf
                <button type="submit">uitloggen</button>
            </form>
        </section>
    </main>
    <footer>
        <p>websheit gemacht dür <a href="https://kurtgustil.be/">kurt<b>gust</b>il</a></p>
    </footer>
</body>
@endsection
