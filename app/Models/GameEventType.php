<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Action;

class GameEventType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'game_event_types';
    protected $fillable = [
        "title",
        "action_id",
    ];
    
    public function action(): BelongsTo
    {
        return $this->belongsTo(Action::class);
    }
}
