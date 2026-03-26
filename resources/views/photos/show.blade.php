@extends('layouts.default')

@section('title','アップロード画像の表示')
@section('content')
    @if(session()->has('success'))
        <p>{{session()->get('success')}}</p>
    @endif

    <img src="{{ asset('storage/photos/'.$fileName) }}" style="width: 500px;" alt="">

    <form action="{{ route('photos.destroy',['photo'=>$fileName]) }}" method="post">
      @csrf
      @method('DELETE')
      <button type="submit">この画像を削除する</button>
    </form>
    <a href="{{ route('photos.download',['photo'=>$fileName]) }}">ダウンロード</a>
@endsection
