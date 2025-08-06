<body>
    <header>
        <h1>MINEZIMMER</h1>
    </header> 
    <main class="middle">
        <div>
            <section>
                <h3>Inloggen</h3>
                <form method="POST" action="{{ route('account.login') }}">
                    @csrf
                    <fieldset>
                        @error('name')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        @error('password')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        <label for="name">Gebruikersnaam</label>
                        <input type="text" name="name" id="name" required autofocus>
                        <label for="password">Wachtwoord</label>
                        <input type="password" name="password" id="password" required>
                    </fieldset>
                    <button type="submit">Inloggen</button>
                </form> 
            </section>
            <section>
                <h3>Aanmelden</h3>
                <form action="{{ route('account.register') }}" method="POST">
                    @csrf
                    <fieldset>
                        @error('register_name')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                        @error('register_password')
                        <p>⚠️ {{$message}}</p>
                        @enderror

                        @error('register_agree')
                        <p>⚠️ {{$message}}</p>
                        @enderror
                         <label for="register-name">Kies een naam</label>
                        <input type="text" name="register_name" id="register-name" placeholder="bv. viespeukje69" required minlength="2">
                        <label for="register-password">Wachtwoord (mag gemakkelijk zijn)</label>
                        <input type="password" name="register_password" id="register-password" placeholder="bv. tetten" required minlength="2">
                        <label for="register-password-check">Wachtwoord herhalen</label>
                        <input type="password" name="register_password_confirmation" id="register-password-check" placeholder="bv. tetten" required>
                        <label for="register_agree"><input type="checkbox" name="register_agree" id="agree" required>ik ga akkoord met vanalles en nogwat</label>
                    </fieldset>    
                    <button type="submit">Maak account aan</button>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <p>websheit gemacht dür <a href="https://kurtgustil.be/">kurt<b>gust</b>il</a></p>
    </footer>
</body>
