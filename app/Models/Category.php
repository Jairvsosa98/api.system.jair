<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Category extends Model
{
    use HasFactory, ApiTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $allowIncluded = ['posts', 'posts.user'];
    protected $allowFilter = ['id', 'name', 'slug'];
    protected $allowSort = ['id', 'name', 'slug'];

    // Relación de uno a muchos
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

   
}
