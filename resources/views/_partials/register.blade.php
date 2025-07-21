<main class="middle">
    <div>
        <section>
            <h2>Inloggen</h2>
            <form method="POST" action="{{ route('account.login') }}">
                @csrf
                <input type="text" name="name" id="name" required autofocus placeholder="Naam">
                <input type="password" name="password" id="password" required placeholder="Wachtwoord">
                <button type="submit">Inloggen</button>
            </form> 
        </section>
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
    </div>
</main>
<footer>
    <p>websheit gemacht dür <a href="https://kurtgustil.be/">kurt<b>gust</b>il</a></p>
</footer>