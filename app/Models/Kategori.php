<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    //
    protected $table = "kategori";
    protected $fillable = ['kategori'];

    public function course() : HasMany {
        return $this->hasMany(Course::class);
    }
}
