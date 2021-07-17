@extends("layouts.app")

@section("content")
    <div class="container">
        <form action="{{ route('alias.create-alias') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Название</label>
                <input class="form-control" name="title">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">URL-адрес</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="url_link" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Создать алиас</button>
        </form>
    </div>
@endsection
