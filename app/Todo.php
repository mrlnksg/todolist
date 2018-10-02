<?php
//Todoテーブル用のモデル
namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  //taskカラムに値を入れることを許可
    protected $fillable = ['task'];
}
