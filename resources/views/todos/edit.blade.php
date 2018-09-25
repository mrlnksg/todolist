@extends('layout')


@section('child')
  {{-- Todoを編集するページ --}}
    <div class="container">
      <h2>edit todo</h2>
      {{-- バリデーションエラー表示 --}}
      @if ($errors->any())
      <div class="alert">
        <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        </ul>
        @endforeach
      </div>
      @endif
      {{-- Todo編集フォーム --}}
      <div class="row">
        <form method="post" action="{{action('TodoController@update', $id)}}">
          {{csrf_field()}}
          <input name="_method" type="hidden" value="PATCH">
          <input type="text" name="task" value="{{$todo->task}}">
          <button type="submit">Update</button>
        </form>
      </div>

    </div>

    {{-- todo一覧ページに移動 --}}
    <div class="container">
      <a href="{{url('todos')}}">back to your list</a>
    </div>

@endsection
