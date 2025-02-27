<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $table = 'grade';
    protected $primaryKey = 'grade_id';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function courses()
    {
        return $this->hasMany(Course::class, 'grade_id', 'grade_id');
    }
}
