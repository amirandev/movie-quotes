<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Directors;

class Movies extends Model
{
    use HasFactory;
    protected $table = 'movies';

    public function director()
    {
        return $this->hasOne(Directors::class, 'id', 'director_id');
    }

}
