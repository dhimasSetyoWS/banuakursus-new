<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CourseSessions;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Tugas extends Model
{
    //
    protected $table = "tugas";
    protected $fillable = ['course_sessions_id' , 'nama_tugas' , 'isi_tugas' , 'tenggat_waktu'];


    public function course_sessions() : BelongsTo {
        return $this->belongsTo(CourseSessions::class);
    }
}
