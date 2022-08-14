@extends('adminlte::page')

@section('title', '本の商品検索')

@section('content_header')
    <h1>本の商品検索</h1>
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

                @section('content')
                
                <form action="/books/search" method="post">
                    @csrf
                    <input type="search" placeholder="キーワード入力" name="search" value="{{ $keyword }}">
                    <div>
                        <button type="submit">検索</button>
                        <button>
                            <a href="/books/search">クリア</a>
                        </button>
                    </div>
                </form>
                @if(isset($keyword))
                <p>{{$keyword->getData()}}</p>
                @endif
                
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
