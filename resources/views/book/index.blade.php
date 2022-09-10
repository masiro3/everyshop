@extends('adminlte::page')

@section('title', '本の商品一覧')

@section('content_header')
    <h1>本の商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('books/add') }}" class="btn btn-default">本の商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>出版社</th>
                                <th>カテゴリー</th>
                                <th>タイトル</th>
                                <th>価格(円)</th>
                                <th>在庫数</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td>{{ $book->publisher->publisher_name }}</td>
                                    <td>{{ $book->category->category_name }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->price }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td>
                                        <form action="/books/stock/minus/{{$book->id}}" method="post">
                                            @csrf
                                            <input type="number" name="number" step="1" min="0" max="10000">
                                            <button type="submit">販売数</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="/books/stock/plus/{{$book->id}}" method="post">
                                            @csrf
                                            <input type="number" name="number" step="1" min="0" max="10000">
                                            <button type="submit">納品数</button>
                                        </form>
                                    </td>
                                    <td><a href="books/edit/{{$book->id}}" type="btn" class="btn btn-default">編集・削除</a></td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
