<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Player;
use App\Models\Manager;

class User extends Authenticatable implements Auditable, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'users';
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'phone',
        'born_date',
        'visibility',
        'photo',
    ];
    protected $auditInclude = [
        'uuid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'phone',
        'born_date',
        'visibility',
        'photo',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function player(){
        return $this->hasOne(Player::class, 'user_id', 'id');
    }
    
    public function manager(){
        return $this->hasOne(Manager::class, 'user_id', 'id');
    }
}
