<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'grade_id';
    protected $fillable = ['name'];
    
    public function classrooms()
    {
        return $this->hasMany(Classroom::class, 'grade_id');
    }
    
    public function courses()
    {
        return $this->hasMany(Course::class, 'grade_id');
    }
}