<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['name', 'max_capacity'];

    public function contents()
    {
        return $this->hasMany(Item::class);
    }
}
