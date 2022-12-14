@extends('adminlte::page')

@section('title', '編集・削除')

@section('content_header')
    <h1>編集・削除</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <body>
                        <h1>ID:{{$book->id}}</h1>
                        <form action='/books/bookEdit' method ="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$book->id}}">
                        <div class="card-body">
                        
                        <div class="form-group">
                                <label>出版社</label>
                                <select type="text" class="form-control" name="publisher_id" required>
                                    <option disabled style='display:none;' @if (empty($book->publisher_id)) selected @endif></option>
                                    @foreach($publishers as $publisher)
                                        <option value="{{ $publisher->id }}" @if (isset($book->publisher_id) && ($book->publisher_id == $publisher->id)) selected @endif>{{ $publisher->publisher_name }}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="form-group">
                                <label>カテゴリー</label>
                                <select class="form-control" name="category_id" required>
                                    <option disabled style='display:none;' @if (empty($book->category_id)) selected @endif></option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if (isset($book->category_id) && ($book->category_id == $category->id )) selected @endif>{{ $category->category_name }}</option>
                                        @endforeach
                                </select>
                            </div>


                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input input type="text" class="form-control" id="title" name="title" value="{{$book->title}}">
                        </div>

                        <div class="form-group">
                            <label for="price">価格(円)</label>
                            <input type="number" min="0" class="form-control" id='price' name="price"value="{{$book->price}}">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫数</label>
                            <input type="number" min="0" class="form-control" id='stock' name="stock" value="{{$book->stock}}">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">編集</button>


                    <a href="/books/bookDelete/{{$book->id}}" type="btn" class="btn btn-success">削除</a>
                    </form>

                    </body>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop