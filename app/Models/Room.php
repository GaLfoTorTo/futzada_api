<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;

class Room extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'rooms';
    protected $fillable = [
        'event_id',
        'status',
        'opened_at',
        'closed_at',
    ];
    protected $auditInclude = [
        'event_id',
        'status',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'opened_at'   => 'datetime',
        'closed_at'   => 'datetime',
        'created_at'   => 'datetime',
        'updated_at'   => 'datetime',
        'deleted_at'   => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
