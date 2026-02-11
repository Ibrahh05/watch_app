<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Watch extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand', 
        'model', 
        'price', 
        'type_id', 
        'strap_id', 
        'ean', 
        'year_edition'
    ];

    public function feature()
    {
        return $this->hasOne(Feature::class);
    }

    public function strap()
    {
        return $this->belongsTo(Strap::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}