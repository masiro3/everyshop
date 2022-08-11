@extends('adminlte::page')

@section('title', '本の商品登録')

@section('content_header')
    <h1>本の商品登録</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form action="{{ url('/books/add')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="publisher_id">出版社</label>
                            <input type="text" class="form-control" id="publisher_id" name="publisher_id" placeholder="出版社">
                        </div>

                        <div class="form-group">
                            <label for="category_id">カテゴリー</label>
                            <input type="text" class="form-control" id="category_id" name="category_id" placeholder="カテゴリー">
                        </div>


                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="カテゴリー">
                        </div>
   
                         {{-- <select type="text" class="form-control" name="prefecture_id" required>
                         <option disabled style='display:none;' @if (empty($post->books)) selected @endif>タイトル選択</option>
                         @foreach($prefectures as $prefecture)
                        <option value="{{ $books->id }}" @if (isset($post->books) && ($post->books === books->id)) selected @endif>{{ $books->name }}</option>
                         @endforeach
                        </select> --}}

                        <div class="form-group">
                            <label for="price">価格(円)</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="価格">
                        </div>

                        <div class="form-group">
                            <label for="stock">納品数</label>
                            <input type="number" class="form-control" id="stock" name="stock" placeholder="納品数(増えた在庫数)">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
