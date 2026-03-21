<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Models\Escalacao;
use App\Models\Economy;

class Manager extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'managers';
    protected $fillable = [
        'user_id',
        'team',
        'alias',
        'primary',
        'secondary',
        'emblem',
        'uniform',
    ];
    protected $auditInclude = [
        'user_id',
        'team',
        'alias',
        'primary',
        'secondary',
        'emblem',
        'uniform',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function escalations(): HasMany
    {
        return $this->hasMany(Escalation::class);
    }

    public function economies(): HasMany
    {
        return $this->hasMany(Economy::class);
    }
}
