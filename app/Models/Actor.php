<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;

    //crear $fillable

    public function films() {
        $this->belongsToMany(Film::class);
    }

}
