<?php
//Todoテーブル用のモデル
namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  //taskカラムに値を入れられるように宣言
    protected $fillable = ['task'];
}
