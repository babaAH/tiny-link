@extends("layouts.app")

@section("content")
    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('alias.update-alias', ['id' => $link->id]) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1" >Алиас</label>
                <input class="form-control" name="alias" value="{{ $link->alias }}" disabled>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" >Название</label>
                <input class="form-control" name="title" value="{{ $link->title }}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">URL-адрес</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="url_link" rows="3" >{{ $link->url }}</textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Описание</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3" >{{ $link->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Изменить алиас</button>
        </form>
    </div>
@endsection
