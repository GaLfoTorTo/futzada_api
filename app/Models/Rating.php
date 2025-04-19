<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Event;
use App\Models\Participant;

class Rating extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'ratings';
    protected $fillable = [
        'event_id',
        'participant_id',
        'modality',
        'points',
        'avarage',
        'valuation',
        'price',
    ];
    protected $auditInclude = [
        'event_id',
        'participant_id',
        'modality',
        'points',
        'avarage',
        'valuation',
        'price',
    ];

    public function event(){
        return $this->belongsTo(Event::class, 'id','event_id');
    }
    
    public function participant(){
        return $this->belongsTo(Participant::class, 'id','participant_id');
    }
}
