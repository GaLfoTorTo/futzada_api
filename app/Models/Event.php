<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Address;
use App\Models\Avaliation;
use App\Models\GameConfig;
use App\Models\User;
use App\Models\Rule;

class Event extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'events';
    protected $fillable = [
        'uuid',
        'title',
        'bio',
        'date',
        'start_time',
        'end_time',
        'modality',
        'collaborators',
        'photo',
        'visibility',
    ];
    protected $auditInclude = [
        'uuid',
        'title',
        'bio',
        'date',
        'start_time',
        'end_time',
        'modality',
        'collaborators',
        'photo',
        'visibility',
    ];

    protected $casts = [
        'date'         => 'array',
        'collaborators' => 'boolean',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    // ─── Boot ────────────────────────────────────────────────────────────────

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Event $event) {
            if (empty($event->uuid)) {
                $event->uuid = (string) Str::uuid();
            }
        });
    }

    // ─── Relationships ────────────────────────────────────────────────────────

    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function gameConfig(): HasOne
    {
        return $this->hasOne(GameConfig::class);
    }

    public function avaliations(): HasMany
    {
        return $this->hasMany(Avaliation::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function rules(): HasMany
    {
        return $this->hasMany(Rule::class);
    }

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
