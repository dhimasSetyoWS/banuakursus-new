<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseSessions extends Model
{
    //
    protected $fillable = ['session_name' , 'description' , 'course_id'];
    public $timestamps = false;

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }
}
