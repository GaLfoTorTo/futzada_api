<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Http\Traits\UsuarioTrait;

class Player extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'players';
    protected $fillable = [
        'user_id',
        'best_side',
        'type',
    ];
    protected $auditInclude = [
        'user_id',
        'best_side',
        'type',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function positions(){
        return $this->beLongsToMany(Position::class, 'player_positions','id','position_id');
    }
}
