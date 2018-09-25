<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8">
    <title> Todo List </title>
    <link rel="stylesheet" href="css/todo.css" type="text/css">
  </head>

  {{-- Todoを新規作成するページ --}}
  <body>
    <div class="container">
      <h2>Write down your todo!</h2>
      {{-- バリデーションエラー表示 --}}
      @if ($errors->any())
      <div class="alert">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <form method="post" action="{{url('todos')}}">
        {{csrf_field()}}
        <input type="text" name="task">
        <button type="submit">do it!</button>
      </form>
      {{-- 成功時表示（新規作成） --}}
      @if (\Session::has('success'))
      <div class="alert">
        <p>{{ \Session::get('success') }}</p>
      </div>
      @endif
    </div>

    {{-- todo一覧ページに移動 --}}
    <div class="container">
      <a href="{{url('todos')}}">show your todos</a>
    </div>

  <body>

</html>
