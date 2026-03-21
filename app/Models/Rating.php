<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;
use App\Models\User;

class Rating extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ratings';
    protected $fillable = [
        'player_id',
        'event_id',
        'user_id',
        'role',
        'points',
        'avarage',
        'valuation',
        'price',
        'games',
    ];
    protected $auditInclude = [
        'player_id',
        'event_id',
        'user_id',
        'role',
        'points',
        'avarage',
        'valuation',
        'price',
        'games',
    ];

    protected $casts = [
        'points'     => 'float',
        'avarage'    => 'float',
        'valuation'  => 'float',
        'price'      => 'float',
        'games'      => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
