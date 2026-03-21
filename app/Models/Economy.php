<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Manager;
use App\Models\Event;

class Economy extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'economies';
    protected $fillable = [
        'event_id',
        'manager_id',
        'patrimony',
        'price',
        'valuation',
        'points',
        'total_points',
    ];
    
    protected $auditInclude = [
        'event_id',
        'manager_id',
        'patrimony',
        'price',
        'valuation',
        'points',
        'total_points',
    ];

    protected $casts = [
        'patrimony'   => 'float',
        'price'       => 'float',
        'valuation'   => 'float',
        'points'      => 'float',
        'total_points' => 'float',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
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
