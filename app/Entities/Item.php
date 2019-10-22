<?php

namespace App\Entities;

use App\Entities\Basket;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = ['weight', 'type'];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}
