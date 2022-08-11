@extends('adminlte::page')

@section('title', '在庫一覧')

@section('content_header')
    <h1>本の商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">本の商品一覧</h3>
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
                                <th>ID</th>
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
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->publisher->publisher_name }}</td>
                                    <td> 
                                        {{-- @if($book-) --}}
                                    @foreach ($book->categories as $category)
                                        {{ $category->category_name }}
                                    @endforeach 
                                    </td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->price }}</td>
                                    <td>{{ $book->stock }}</td>
                                    <td>販売数</td>
                                    <td>納品数</td>
                                    <td>編集</td>
                                    <td>消除</td>

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
