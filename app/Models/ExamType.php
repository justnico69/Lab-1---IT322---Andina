<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;

    protected $table = 'exam_type';
    protected $primaryKey = 'exam_type_id';
    public $timestamps = false;

    protected $fillable = [
        'name', 'description'
    ];

    public function exams()
    {
        return $this->hasMany(Exam::class, 'exam_type_id', 'exam_type_id');
    }
}
