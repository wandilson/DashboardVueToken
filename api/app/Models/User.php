<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Scopes\Tenant\TenantScope;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'tenant_id',
        'city_id',
        'state_id',
        'stats',
        'type',
        'cpf',
        'name_first',
        'name_last',
        'birth',
        'cell_phone',
        'address',
        'zip_code',
        'information',
        'email',
        'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    public static function boot()
    {
        parent::boot();
        static::addGlobalScope(new TenantScope);
    }*/

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

}
