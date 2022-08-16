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
                            <label>出版社</label>
                            <select type="text" class="form-control" name="publisher_id" required>
                                <option disabled style='display:none;'></option>
                                @foreach($publishers as $publisher)
                                    <option value="{{ $publisher->id }}">{{ $publisher->publisher_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>カテゴリー</label>
                            <select  class="form-control" name="category_id" required>
                                <option disabled style='display:none;'></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">タイトル</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="タイトル">
                        </div>

                        <div class="form-group">
                            <label for="price">価格(円)</label>
                            <input type="number" min="0" class="form-control" id="price" name="price" placeholder="価格">
                        </div>

                        <div class="form-group">
                            <label for="stock">在庫数</label>
                            <input type="number" min="0" class="form-control" id="stock" name="stock" placeholder="納品数(増えた在庫数)">
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
