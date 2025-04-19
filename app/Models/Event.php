<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Participant;

class Event extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'events';
    protected $fillable = [
        'uuid',
        'title',
        'bio',
        'address',
        'number',
        'city',
        'state',
        'complement',
        'country',
        'zip_code',
        'days_week',
        'date',
        'start_time',
        'end_time',
        'category',
        'qtd_players',
        'visibility',
        'allow_collaborators',
        'photo',
    ];
    protected $auditInclude = [
        'uuid',
        'title',
        'bio',
        'address',
        'number',
        'city',
        'state',
        'complement',
        'country',
        'zip_code',
        'days_week',
        'date',
        'start_time',
        'end_time',
        'category',
        'qtd_players',
        'visibility',
        'allow_collaborators',
        'photo',
    ];

    public function participantes(){
        return $this->hasMany(Participant::class);
    }
}
