<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('style.css')}}">
    <title>Kamercollecties</title>
</head>
<body>
    <header>
        <h1>Kamercollecties</h1>
        @auth
        <section id="controle-panel">
            <form action="{{ route('room.create')}}" method="POST">
                @csrf
                <input type="text" name="name" id="name">
                <input type="hidden" name="level" value="0">
                <input type="hidden" name="upper_room">
                <button type="submit">maak ruimte</button>
            </form>
            <form action="{{ route('account.logout') }}" method="POST">
                @csrf
                <button type="submit">Uitloggen</button>
            </form>
        </section>
        @endauth
    </header>
    
    @auth
    <h2>Eigen collectie</h2>
        @for ($i = 1; $i < 8; $i++)
        <a>Lijst {{$i}}</a>
        @endfor
    <h2>Ruimtes</h2>
        @foreach ($rooms as $room)
        <a href="{{ url('/' . $room->id . '-' . $room->name) }}">{{ $room->name }}</a>            
        @endforeach  
    @else
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
     @endauth
</body>
</html>