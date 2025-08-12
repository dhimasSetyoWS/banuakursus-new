<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Artikel;
use App\Models\Course;
use App\Models\Tugas;
use Illuminate\Database\Eloquent\Model;

class CourseSessions extends Model
{
    //
    protected $fillable = ['session_name' , 'start_session' , 'end_session' , 'course_id'];
    public $timestamps = false;

    public function course(): BelongsTo {
        return $this->belongsTo(Course::class);
    }

    // Relasi ke Artikel (jika kategori 'artikel')
    public function artikel(): HasOne
    {
        // Foreign key 'course_session_id' ada di tabel 'artikels'
        return $this->hasOne(Artikel::class);
    }

    // Relasi ke Tugas (jika kategori 'tugas')
    public function tugas(): HasOne
    {
        // Foreign key 'course_session_id' ada di tabel 'tugas'
        return $this->hasOne(Tugas::class);
    }

}
