<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    // Método para activar la relación polimórfica
    public function imageable(){
        return $this->morphTo();
    }

}
