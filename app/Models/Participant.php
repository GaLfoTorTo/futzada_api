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
        'event_id',
        'user_id',
        'role',
        'permissions',
        'status',
        'joinedt_at'
    ];
    protected $auditInclude = [
        'event_id',
        'user_id',
        'role',
        'permissions',
        'status',
        'joinedt_at'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id','user_id');
    }
    
    public function event(){
        return $this->belongsTo(Event::class, 'id','event_id');
    }
    
    public function pontuations(){
        return $this->hasMany(Pontuation::class);
    }
   
    public function performance(){
        return $this->hasMany(Performance::class);
    }
}