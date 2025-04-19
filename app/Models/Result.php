<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;
use App\Models\Game;
use App\Models\Team;

class Result extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'results';
    protected $fillable = [
        'event_id',
        'game_id',
        'team_a_id',
        'team_b_id',
        'team_a_score',
        'team_b_score',
        'status',
        'duration',
    ];
    protected $auditInclude = [
        'event_id',
        'team_a_id',
        'team_b_id',
        'team_a_score',
        'team_b_score',
        'status',
        'duration',
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'id','event_id');
    }
    
    public function game(){
        return $this->belongsTo(Game::class, 'id','game_id');
    }

    public function team_a(){
        return $this->beLongsTo(Team::class, 'id','team_a_id');
    }
    
    public function team_b(){
        return $this->beLongsTo(Team::class, 'id','team_b_id');
    }
}
