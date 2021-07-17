@extends("layouts.app")

@section("content")
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Алиас</th>
                <th scope="col">Название</th>
                <th scope="col">Ссылка</th>
            </tr>
            </thead>
            <tbody>
            @foreach($links as $link)
                <tr>
                    <th scope="row">{{ $link->id }}</th>
                    <td><a href="{{ route("tiny-link", ["alias" => $link->alias]) }}"></a>{{ $link->alias }}</td>
                    <td>{{ $link->title }}</td>
                    <td><a href="{{ $link->url }}">Перейти</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
