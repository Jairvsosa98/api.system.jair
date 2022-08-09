<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\ApiTrait;

class Image extends Model
{
    use HasFactory, ApiTrait;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    // Método para activar la relación polimórfica
    public function imageable(){
        return $this->morphTo();
    }

}
