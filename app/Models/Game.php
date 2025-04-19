<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Models\Event;
use App\Models\Team;
use App\Models\Result;

class Game extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'games';
    protected $fillable = [
        'number',
        'event_id',
        'referee_id',
        'duration',
        'start_time',
        'end_time',
        'status'
    ];
    protected $auditInclude = [
        'numero',
        'event_id',
        'referee_id',
        'duration',
        'start_time',
        'end_time',
        'status'
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'id','event_id');
    }
    
    public function referee(){
        return $this->belongsTo(User::class, 'id','referee_id');
    }
    
    public function result(){
        return $this->hasOne(Result::class);
    }
   
    public function teams(){
        return $this->hasMany(Team::class);
    }
}
