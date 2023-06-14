<?php

namespace Romanlazko\Telegram\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use HasFactory; use SoftDeletes;

    protected $guarded = [];

    public function images()
    {
        return $this->hasMany(AdvertisementImage::class, 'advertisement_id', 'id');
    }

    public function delivery() 
    {
        return $this->hasMany(AdvertisementDelivery::class, 'advertisement_id', 'id');
    }

    public function distributions() 
    {
        return $this->hasMany(Distribution::class, 'advertisement_id', 'id');
    }
}
