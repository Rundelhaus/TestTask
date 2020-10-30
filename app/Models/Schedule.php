<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [ 'grade', 'parallel'];

    public function items()
    {
        return $this->hasMany(ScheduleItem::class, 'schedule_id');
    }
}
