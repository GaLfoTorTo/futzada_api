<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Player;
use App\Models\Position;

class PlayerPosition extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'player_positions';
    protected $fillable = [
        'player_id',
        'position_id',
        'main',
    ];
    protected $auditInclude = [
        'player_id',
        'position_id',
        'main',
    ];

    public function player(){
        return $this->belongsTo(Player::class,'player_id', 'id');
    }

    public function posicoes(){
        return $this->beLongsTo(Position::class, 'position_id', 'id');
    }
}
