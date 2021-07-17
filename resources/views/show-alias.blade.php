@extends("layouts.app")

@section("content")

    <div class="container">
        <div class="form-group">
            <label for="exampleInputEmail1" >Алиас</label>
            <input class="form-control" name="alias" value="{{ $link->alias }}" disabled>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1" >Название</label>
            <input class="form-control" name="title" value="{{ $link->title }}"  disabled>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">URL-адрес</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="url_link" rows="3"  disabled>{{ $link->url }}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Описание</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"  disabled>{{ $link->description }}</textarea>
        </div>
    </div>
@endsection
