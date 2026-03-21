<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Address extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'address';
    protected $fillable = [
        'event_id',
        'street',
        'number',
        'suburb',
        'borough',
        'city',
        'state',
        'country',
        'zip_code',
        'latitude',
        'longitude',
        'photos',
    ];

    protected $auditInclude = [
        'event_id',
        'street',
        'number',
        'suburb',
        'borough',
        'city',
        'state',
        'country',
        'zip_code',
        'latitude',
        'longitude',
        'photos',
    ];

    protected $casts = [
        'latitude'   => 'float',
        'longitude'  => 'float',
        'photos'     => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
