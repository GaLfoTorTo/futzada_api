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
        'roles',
        'permissions',
        'status',
    ];
    
    protected $auditInclude = [
        'user_id',
        'event_id',
        'roles',
        'permissions',
        'status',
    ];

    protected $casts = [
        'roles'       => 'array',
        'permissions' => 'array',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
        'deleted_at'  => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
    public function pontuations()
    {
        return $this->hasMany(Pontuation::class);
    }
   
    public function performance()
    {
        return $this->hasMany(Performance::class);
    }
}