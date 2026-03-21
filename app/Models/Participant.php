<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Models\Event;
use App\Models\Pontuation;
use App\Models\Performance;

class Participant extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'participants';
    protected $fillable = [
        'user_id',
        'event_id',
        'role',
        'permissions',
        'status',
    ];
    
    protected $auditInclude = [
        'user_id',
        'event_id',
        'role',
        'permissions',
        'status',
    ];

    protected $casts = [
        'role'        => 'array',
        'permissions' => 'array',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
    
    public function pontuations(): BelongsTo
    {
        return $this->hasMany(Pontuation::class);
    }
   
    public function performance(): BelongsTo
    {
        return $this->hasMany(Performance::class);
    }
}