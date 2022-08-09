<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Post extends Model
{
    use HasFactory, ApiTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    const BORRADOR = 1;
    const PUBLICADO = 2;


    // Relación uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    // Relación muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    // Relación uno a muchos polimórfica
    public function images(){
        return $this->morphToMany(Image::class, 'imageable');
    }
}
