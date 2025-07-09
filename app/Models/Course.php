<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    //
    use HasFactory;
    protected $fillable = ['title_course' , 'description' , 'price' , 'user_id', 'period_id'];

    public function course_sessions() : HasMany {
        return $this->hasMany(CourseSessions::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public static function useFactory() {
        return CourseFactory::new();
    }
}
