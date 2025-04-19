<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Game;
use App\Models\Manager;

class Escalation extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'equipes';
    protected $fillable = [
        'manager_id',
        'game_id',
        'formation',
    ];
    protected $auditInclude = [
        'manager_id',
        'game_id',
        'formation',
        'capitao_id',
    ];

    public function game(){
        return $this->belongsTo(Game::class, 'id','game_id');
    }
    
    public function manager(){
        return $this->belongsTo(Manager::class, 'id','manager_id');
    }
}
