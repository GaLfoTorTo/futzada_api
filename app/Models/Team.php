<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;
use App\Models\Participante;

class Team extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'teams';
    protected $fillable = [
        'uuid',
        'event_id',
        'name',
    ];
    protected $auditInclude = [
        'uuid',
        'event_id',
        'name',
    ];
    
    public function event(){
        return $this->belongsTo(Event::class, 'id','event_id');
    }
}
