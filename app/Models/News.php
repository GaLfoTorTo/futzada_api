<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;

class News extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'news';
    protected $fillable = [
        'event_id',
        'user_id',
        'type_id',
        'title',
        'description',
    ];
    protected $auditInclude = [
        'event_id',
        'user_id',
        'type_id',
        'title',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // ─── Relationships ────────────────────────────────────────────────────────

    public function type()
    {
        return $this->belongsTo(EventType::class, 'type_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
