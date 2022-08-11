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

            <div>
                <form action="{{ route('books.index') }}" method="GET">
                  <input type="text" name="keyword" value="{{ $keyword }}">
                  <input type="submit" value="検索">
                </form>
            </div>


        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop

