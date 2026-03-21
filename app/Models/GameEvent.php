<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\Game;
use App\Models\GameEventType;
use App\Models\User;
use App\Models\Team;
use App\Models\Action;

class GameEvent extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'game_events';
    protected $fillable = [
        "game_id",
        "userId",
        "teamId",
        "action_id",
        "minute",
        "title",
        "description",
    ];
    protected $auditInclude = [
        "game_id",
        "userId",
        "teamId",
        "action_id",
        "minute",
        "title",
        "description",
    ];

    public function game(): BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
    
    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
