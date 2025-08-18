<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Exam extends Model
{
    //
    protected $fillable = ['title_exam', 'course_session_id' , 'exam_questions_id' , 'duration'];

    public function course_session() : BelongsTo {
        return $this->belongsTo(CourseSessions::class);
    }
    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class, 'exam_questions', 'exam_id', 'question_id');
    }
}
