<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta property="og:locale" content="nl_BE">
    <link rel="stylesheet" href="{{ asset('style.css')}}">
    @yield('scripts')
    <title>MINEZIMMER</title>
</head>

@auth
@yield('body')    
@else
@include('_partials.register')
@endauth

</html>