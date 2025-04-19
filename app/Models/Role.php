<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;

class Role extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'roles';
    protected $fillable = [
        'event_id',
        'title',
        'description',
    ];
    protected $auditInclude = [
        'event_id',
        'title',
        'description',
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'id','event_id');
    }
}
