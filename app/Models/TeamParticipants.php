<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Team;
use App\Models\Participante;

class TeamParticipants extends Model
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'team_participants';
    protected $fillable = [
        'team_id',
        'participant_id',
        'capitan',
        'type',
    ];
    protected $auditInclude = [
        'team_id',
        'participant_id',
        'capitan',
        'type',
    ];
    
    public function team(){
        return $this->belongsTo(Team::class, 'id','team_id');
    }
    
    public function participant(){
        return $this->belongsTo(Participant::class, 'id','participant_id');
    }
}
