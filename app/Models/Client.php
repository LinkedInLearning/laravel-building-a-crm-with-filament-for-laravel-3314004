<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'photo',
        'linkedin',
        'active',
        'title',
        'company',
        'role',
        'company_website',
        'business_details',
        'business_type',
        'company_size',
        'temperature',
        'notes',
        'referrals'
        ];

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class);
    }
}
