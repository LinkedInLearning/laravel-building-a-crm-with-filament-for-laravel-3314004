<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;


    public $fillable = [
        'name',
        'street',
        'zip',
        'city_id',
        'client_id',
    ];

    /**
     * Get the city that owns the address.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Get the client that owns the address.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
