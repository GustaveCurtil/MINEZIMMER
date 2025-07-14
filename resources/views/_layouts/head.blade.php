<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css')}}">
    @yield('scripts')
    <title>Kamercollecties</title>
</head>
<style>
    body {
        color: @yield('color');
        background-color: @yield('bgColor');
    }
</style>
    
@auth
@yield('body')
@else
<body id="aanmelden">
    <main>
        <h3>Aanmelden</h3>
        <form action="{{ route('account.register') }}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="Naam" required minlength="2">
            <input type="password" name="password" id="password" placeholder="Wachtwoord" required minlength="2">
            <input type="password" name="password_confirmation" id="password-check" placeholder="Wachtwoord check" required>
            <label for="agree"><input type="checkbox" name="agree" id="agree" required>ik ga akkoord</label>
            <button type="submit">Maak login aan</button>
        </form>
        <h3>Inloggen</h3>
        <form method="POST" action="{{ route('account.login') }}">
            @csrf
            <input type="text" name="name" id="name" required autofocus>
            <input type="password" name="password" id="password" required>
            <button type="submit">Inloggen</button>
        </form>
    </main>
</body>
@endauth
</html>