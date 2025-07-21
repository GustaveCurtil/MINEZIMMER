@extends('_layouts.head')

@section('main')

<main class="middle no-footer">
    <div>
        <section class="center">
                <form action="{{ route('room.create')}}" method="POST">
                    @csrf
                    <input type="text" name="name" id="name">
                    <button type="submit">Zimmerke machen</button>
                </form>
        </section>
    </div>
</main>

@endsection
