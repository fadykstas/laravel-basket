<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    const ALLOWED_TYPES = ['apple', 'orange', 'watermelon'];

    protected $guarded = ['weight', 'type'];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}
