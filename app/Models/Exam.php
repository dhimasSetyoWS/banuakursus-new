<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    //
    protected $fillable = ['title_exam', 'course_session_id' , 'exam_questions_id' , 'duration'];

    public function exam_question() : BelongsTo {
        return $this->belongsTo(ExamQuestion::class);
    }
    public function course_session() : BelongsTo {
        return $this->belongsTo(CourseSessions::class);
    }
}
