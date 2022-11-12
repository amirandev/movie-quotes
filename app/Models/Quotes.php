<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Directors;
use App\Models\Movies;

class Quotes extends Model
{
    use HasFactory;
    protected $table = 'quotes';

    public function movie()
    {
        return $this->hasOne(Movies::class, 'id', 'movie_id');
    }
}
