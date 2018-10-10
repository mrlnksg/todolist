<?php
//Todoテーブル用のモデル
namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
  //taskカラムに値を入れることを許可
    protected $fillable = ['task', 'label', 'deadline'];

    /**
      * labelで絞り込みをおこなう
      * @param \Illuminate\Database\Eloquent\Builder $query
      * @param string|null $label
      * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeLabelFilter($query, $label)
    {
      if (!is_null($label)) {
        return $query->where('label', $label);
      }
      return $query;
    }

    /**
      * deadlineで絞り込みをおこなう
      * @param \Illuminate\Database\Eloquent\Builder $query
      * @param string|null $deadline
      * @return \Illuminate\Database\Eloquent\Builder
    */
    public function scopeDeadlineFilter($query, $deadline)
    {
      if (!is_null($deadline)) {
        return $query->where('deadline', $deadline);
      }
      return $query;
    }
}
