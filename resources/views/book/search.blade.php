

                @extends('adminlte::page')

                @section('title', '本の商品一覧検索')
                
                @section('content_header')
                    <h1>本の商品一覧検索</h1>
                @stop
                
                @section('content')
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm">
                                            
                                        </div>
                                    </div>
                                </div>
                 <div class="card-body table-responsive p-0">
                
                <form action="/books/search" method="post">
                    @csrf
                    <div>出版社・カテゴリー・タイトル検索</div>
                    <input type="search" placeholder="キーワード入力" name="keyword"  value="{{ $keyword }}">
                    <div>
                        <button type="submit">検索</button>
                    </div>
                </form>
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
                    
                    <td>{{ $book->publisher_name }}</td>
                    <td>{{ $book->category_name }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->price }}</td>
                    <td>{{ $book->stock }}</td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
