<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Question extends Model
{
    //
    protected $fillable = ['question'];

    public function answers() : HasMany {
        return $this->hasMany(Answer::class);
    }

    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_questions', 'question_id', 'exam_id');
    }

    public function correctAnswer(): BelongsTo
    {
        return $this->belongsTo(Answer::class, 'correct_answer_id');
    }
}
