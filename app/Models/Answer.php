<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    //
    protected $fillable = ['answer_text' , 'question_id'];

    public function question() : BelongsTo {
        return $this->belongsTo(Question::class);
    }
}
