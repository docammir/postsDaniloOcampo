<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';

    public function categories()
    {
        return $this->belongsTo(Category::class, 'categoria_id');
    }

    protected $fillable = [
        'titulo',
        'contenido',
        'categoria_id',
    ];
}
