<body>
    <header>
        <h1>MINEZIMMER</h1>
    </header> 
    <main class="middle">
        <div>
            <section>
                <h2>Inloggen</h2>
                <form method="POST" action="{{ route('account.login') }}">
                    @csrf
                    @error('name')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    @error('password')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <input type="text" name="name" id="name" required autofocus placeholder="Naam">
                    <input type="password" name="password" id="password" required placeholder="Wachtwoord">
                    <button type="submit">Inloggen</button>
                </form> 
            </section>
            <section>
                <h2>Aanmelden</h2>
                <form action="{{ route('account.register') }}" method="POST">
                    @csrf
                    @error('register_name')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    @error('register_password')
                    <p>⚠️ {{$message}}</p>
                    @enderror

                    @error('register_agree')
                    <p>⚠️ {{$message}}</p>
                    @enderror
                    <input type="text" name="register_name" id="name" placeholder="Naam" required minlength="2">
                    <input type="password" name="register_password" id="password" placeholder="Wachtwoord" required minlength="2">
                    <input type="password" name="register_password_confirmation" id="password-check" placeholder="Wachtwoord check" required>
                    <label for="register_agree"><input type="checkbox" name="register_agree" id="agree" required>ik ga akkoord</label>
                    <button type="submit">Maak account aan</button>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <p>websheit gemacht dür <a href="https://kurtgustil.be/">kurt<b>gust</b>il</a></p>
    </footer>
</body>
