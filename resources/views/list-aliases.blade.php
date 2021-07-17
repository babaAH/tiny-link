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
                    <td><label class="js-alias-links">{{ route('tiny-link', ['alias' => $link->alias]) }}</label> </td>
                    <td><a href="{{ route('alias.show-update-form', [ 'id' => $link->id ]) }}">{{ $link->title }}</a></td>
                    <td><a href="{{ $link->url }}">Перейти</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    <div class="d-flex justify-content-center">
        {{ $links->links() }}
    </div>
@endsection

@section("scripts")
    <script src="{{ asset("js/aliasLinkToClipboard.js") }}"></script>

@endsection
