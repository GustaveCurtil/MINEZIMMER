<header>
    <div>
        <h1>
            MINEZIMMER 1.0
            <svg width="60" height="60" viewBox="0 0 60 60">
                <path d="M30 0L37.082 22.918H60L41.459 37.082L48.541 60L30 45.8359L11.459 60L18.541 37.082L0 22.918H22.918L30 0Z" fill="black"/>
            </svg>
        </h1>
    </div>
</header>
<main id="login">
    <section>
        <h2>Aanmelden</h2>
        <form action="{{ route('account.register') }}" method="POST">
            @csrf
            <input type="text" name="name" id="name" placeholder="Naam" required minlength="2">
            <input type="password" name="password" id="password" placeholder="Wachtwoord" required minlength="2">
            <input type="password" name="password_confirmation" id="password-check" placeholder="Wachtwoord check" required>
            <label for="agree"><input type="checkbox" name="agree" id="agree" required>ik ga akkoord</label>
            <button type="submit">Maak login aan</button>
        </form>
    </section>
    <section>
        <h2>Inloggen</h2>
        <form method="POST" action="{{ route('account.login') }}">
            @csrf
            <input type="text" name="name" id="name" required autofocus placeholder="Naam">
            <input type="password" name="password" id="password" required placeholder="Wachtwoord">
            <button type="submit">Inloggen</button>
        </form> 
    </section>
    
</main>
<footer></footer>