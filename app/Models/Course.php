<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Database\Factories\CourseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Course extends Model
{
    //
    use HasFactory;
    protected $fillable = ['title_course', 'slug' , 'description' , 'price' , 'user_id', 'period_id' , 'kategori_id'];

    public function course_sessions() : HasMany {
        return $this->hasMany(CourseSessions::class);
    }

    public function kategori() : BelongsTo {
        return $this->belongsTo(Kategori::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function registeredUsers(): BelongsToMany
    {
        // Parameter: Model terkait, nama tabel pivot, foreign key model ini di pivot, foreign key model terkait di pivot
        return $this->belongsToMany(User::class, 'register_courses', 'course_id', 'user_id');
    }

    public static function useFactory() {
        return CourseFactory::new();
    }
}
