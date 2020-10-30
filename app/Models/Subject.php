<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [ 'name', 'teacher_id', 'hours'];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function scheduleItems()
    {
        return $this->hasMany(ScheduleItem::class, 'subject_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class, 'subject_id');
    }
}
