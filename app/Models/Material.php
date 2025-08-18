<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\CourseSessions;

class Material extends Model
{
    //
    protected $fillable = ['title' , 'content' , 'course_session_id'];

    public function course_sessions() : BelongsTo {
        return $this->belongsTo(CourseSessions::class);
    }
}
