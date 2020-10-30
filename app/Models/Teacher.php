<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [ 'employment_date', 'layoff_date', 'user_id'];

    public function marks()
    {
        return $this->hasMany(Mark::class, 'teacher_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}