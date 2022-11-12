<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Movies;

class Directors extends Model
{
    use HasFactory;
    protected $table = 'directors';

    public function movies(){
        return $this->hasMany(Movies::class, 'director_id');
    }
}
