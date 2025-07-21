<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css')}}">
    @yield('scripts')
    <title>MINEZIMMER</title>
</head>

<body>
    <header>
        <h1>
            @if (!request()->routeIs('home'))
            <a href="{{ route('home') }}">MINEZIMMER</a>
            @else
            MINEZIMMER
            @endif
        </h1>
        @auth
        @if (request()->routeIs('settings'))
        <p style="font-size: 0.9rem">{{ $user->name }}</p>
        @else 
        <a href="{{ route('settings') }}">{{$user->name}}</a>
        @endif
        @endauth
    </header>
@auth
@yield('main')    
@else
@include('_partials.register')
@endauth
    
</body>
</html>