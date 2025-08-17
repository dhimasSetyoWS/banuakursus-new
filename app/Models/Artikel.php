<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CourseSessions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Artikel extends Model
{
    //
    protected $table = "artikel";

    protected $fillable = ['judul' , 'konten' , 'course_session_id'];

    public function course_sessions() : BelongsTo {
        return $this->belongsTo(CourseSessions::class);
    }
}
