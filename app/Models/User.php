<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Models\Achievement;
use App\Models\Player;
use App\Models\Manager;
use App\Models\Level;
use App\Models\Participant;
use App\Models\UserConfig;

class User extends Authenticatable implements Auditable, JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'users';
    protected $fillable = [
        'uuid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'born_date',
        'phone',
        'photo',
        'privacy',
    ];
    protected $audiInclude = [
        'uuid',
        'first_name',
        'last_name',
        'user_name',
        'email',
        'password',
        'born_date',
        'phone',
        'photo',
        'privacy',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'born_date'         => 'date',
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
        'created_at'        => 'datetime',
        'updated_at'        => 'datetime',
        'deleted_at'        => 'datetime',
    ];

    // ─── Boot ────────────────────────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user) {
            if (empty($user->uuid)) {
                $user->uuid = (string) Str::uuid();
            }
        });
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function config()
    {
        return $this->hasOne(UserConfig::class);
    }

    public function player()
    {
        return $this->hasOne(Player::class);
    }

    public function manager()
    {
        return $this->hasOne(Manager::class);
    }

    public function level()
    {
        return $this->belongsToMany(Level::class, 'user_levels','user_id','level_id')->withPivot('points');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }
    
    public function achievements()
    {
        return $this->beLongsTo(Achievement::class, 'user_achievements', 'user_id', 'achievement_id');
    }

    // ─── Token Methods ────────────────────────────────────────────────────────

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
