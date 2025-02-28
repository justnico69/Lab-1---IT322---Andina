<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'exam_id';
    protected $fillable = ['exam_type_id', 'name', 'start_date'];
    
    public function examType()
    {
        return $this->belongsTo(ExamType::class, 'exam_type_id');
    }
    
    public function examResults()
    {
        return $this->hasMany(ExamResult::class, 'exam_id');
    }
}