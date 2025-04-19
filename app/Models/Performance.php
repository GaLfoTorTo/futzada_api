<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Game;
use App\Models\Participant;
use App\Models\Team;
use App\Models\Action;

class Performance extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'performances';
    protected $fillable = [
        'game_id',
        'participant_id',
        'team_id',
        'actions',
        'total_points'
    ];
    protected $auditInclude = [
        'game_id',
        'participant_id',
        'team_id',
        'actions',
        'total_points'
    ];

    public function game(){
        return $this->belongsTo(Game::class, 'id','game_id');
    }

    public function participant(){
        return $this->belongsTo(Participante::class, 'id','participant_id');
    }
    
    public function team(){
        return $this->belongsTo(Team::class, 'id','team_id');
    }
}
