@extends("layouts.app")

@section("content")
    <form action="{{ route('alias.create-alias-form') }}" method="post">
        <input type="text" name="alias" required>
        <input type="textarea" name="url" required>
        <button type="submit">Создать алиас</button>
    </form>
@endsection
