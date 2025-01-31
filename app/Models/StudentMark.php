<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $fillable = ['student_name', 'subject_id', 'mark'];

    public static function getTableName() {
        return with(new static)->getTable();
    }

    public function subject()  {
        return $this->belongsTo (Subject::class);
    }


}
