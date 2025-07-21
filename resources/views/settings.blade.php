@extends('_layouts.head')

@section('main')

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

@endsection
