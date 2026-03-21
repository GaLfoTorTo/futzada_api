<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;
use App\Models\Manager;

class Escalation extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'escalations';
    protected $fillable = [
        'event_id',
        'manager_id',
        'formation',
        'starters',
        'reserves',
    ];
    protected $auditInclude = [
        'event_id',
        'manager_id',
        'formation',
        'starters',
        'reserves',
    ];

    protected $casts = [
        'starters'   => 'array',
        'reserves'   => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }
}
