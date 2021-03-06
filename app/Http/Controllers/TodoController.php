<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //Todoテーブル内の全てのモデルを取得
        //$todos = Todo::all();

        $todos = Todo::labelFilter(request('label')) //検索されたラベルを受け取る
        ->orderBy('id','desc') //Todoテーブル内のIDを降順で
        ->paginate(10); //ページにつき10件ずつ取得

      //データの合計を数える
        $count = Todo::count();
      //todo.indexに変数todos,countを受け渡す
        return view('todos.index', compact('todos', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $todo = $this->validate(request(),[
          'task' => 'required',  //taskを必須項目とする
          'label' => 'present'  //labelフィールドが存在する(中身は空でもOK)
        ]);
      //Todoテーブル内に、todoを新規作成
        Todo::create($todo);
      //直前ページ（create画面）に成功メッセージを出す
        return back()->with('success', 'Todo has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //指定したidを取得する
        $todo = Todo::find($id);
        return view('todos.edit', compact('todo', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //指定したidを取得する
        $todo = Todo::find($id);
      //taskを必須とするバリデーション
        $this->validate(request(), [
          'task' => 'required'
        ]);
      //taskを上書き
        $todo->task = $request->get('task');
      //labelを上書き
        $todo->label = $request->get('label');
      //保存
        $todo->save();
        return redirect('todos')->with('success', 'Todo has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
      //削除
        $todo->delete();
        return redirect('todos')->with('success', 'Todo has been deleted');
    }

}
