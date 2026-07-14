<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['region_id', 'name', 'lat', 'long'];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
