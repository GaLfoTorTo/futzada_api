<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Escalation;
use App\Models\Participant;

class EscalationParticipants extends Model
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'escalation_participants';
    protected $fillable = [
        'escalation_id',
        'participant_id',
        'role',
        'is_captain',
    ];
    protected $auditInclude = [
        'escalation_id',
        'participant_id',
        'role',
        'is_captain',
    ];

    public function escalation(){
        return $this->belongsTo(Escalation::class, 'id','escalation_id');
    }
    
    public function participante(){
        return $this->belongsTo(Participant::class, 'id','participant_id');
    }
}
