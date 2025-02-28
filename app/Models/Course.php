<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'course_id';
    protected $fillable = ['name', 'description', 'grade_id'];
    
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'course_id');
    }
}
