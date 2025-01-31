<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_name'];

    public static function getTableName() {
        return with(new static)->getTable();
    }

    public function user() {
        return $this->hasMany(StudentMark::class);
    }
}
