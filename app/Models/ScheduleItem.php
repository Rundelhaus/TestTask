<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduleItem extends Model
{
    use HasFactory;

    protected $fillable = [ 'subject_id', 'schedule_id', 'item_start'];

    public function subjects()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
