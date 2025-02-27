<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table = 'classroom';
    protected $primaryKey = 'classroom_id';
    public $timestamps = false;

    protected $fillable = [
        'year', 'grade_id', 'section', 'status', 'remarks', 'teacher_id'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'classroom_student', 'classroom_id', 'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'teacher_id');
    }
}
