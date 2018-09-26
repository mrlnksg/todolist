@extends('layout')


@section('child')
  {{-- 作ったTodoを表示させるページ --}}
    <div class="container">
      <h2>Here's your list!</h2>
      {{-- 成功時表示(編集・削除) --}}
      @if (\Session::has('success'))
      <div class="alert">
        <p>{{ \Session::get('success') }}</p>
      </div>
      @endif
      {{-- 表の部分 --}}
      <table class="table">
        <thead>
          <tr>
            <th>No.</th>
            <th>task</th>
            <th>date</th>
            <th colspan="2">action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($todos as $todo)
          <tr>
            <td>{{$todo['id']}}</td>
            <td>{{$todo['task']}}</td>
            {{-- taskが編集済の場合に編集後の日付にかえる --}}
            <td>
              @if($todo['created_at'] == $todo['updated_at'])
                {{$todo['created_at']}}
              @else
                {{$todo['updated_at']}}
              @endif</td>
            <td>
              <a href="{{action('TodoController@edit', $todo['id'])}}" class="btn">edit</a></td>
            <td>
              <form action="{{action('TodoController@destroy', $todo['id'])}}" method='post'>
                {{csrf_field()}}
                <input name="_method" type="hidden" value="DELETE">
                <button class="btn btn-dell" type="submit">delete</button></td>
              </form>
          </tr>
            @endforeach
        </tbody>
      </table>

      {{-- ページング --}}
      <p>{{ $todos->links() }}</p>
    </div>

    {{-- todo作成ページに移動 --}}
    <div class="container">
      <a href="{{url('todos/create')}}">note another task</a>
    </div>

@endsection
