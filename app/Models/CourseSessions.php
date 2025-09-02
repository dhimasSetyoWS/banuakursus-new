<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CourseSessions extends Model
{
    //
    protected $fillable = ['session_name' , 'start_session' , 'end_session' , 'course_id'];

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    // Relasi ke Material
    public function material() : HasMany {
        return $this->hasMany(Material::class, 'course_session_id');
    }

    public function exam() : HasMany {
        return $this->hasMany(Exam::class, 'course_session_id');
    }
}
