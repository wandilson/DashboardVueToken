<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = [
        'tenant_id', 'user_id', 'name', 'amount',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }


    
}
