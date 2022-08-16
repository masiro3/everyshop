@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    
@stop

@section('content')

<!DOCTYPE HTML>
<html>
<head>
    <title>掲示板</title>
</head>
<body>

<h1>掲示板</h1>

<!-- エラーメッセージエリア -->
@if ($errors->any())
    <h2>エラーメッセージ</h2>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<!-- フォームエリア -->
<form action="/" method="post">
    コメント:<br>
    <textarea name="comment" rows="2" cols="40" placeholder="５文字以上入力"></textarea>
    {{ csrf_field() }} <br>
    <button class="btn btn-success">送信</button>
</form>

<!-- 投稿表示エリア -->
@isset($home)
@foreach ($home as $h)
<br>{{ $h->comment }}<br><a href="/homeDelete/{{$h->id}}" type="btn" class="btn btn-primary">削除</a>
    <br><hr>
@endforeach
@endisset




</body>
</html>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

