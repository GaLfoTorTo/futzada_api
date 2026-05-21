<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Achievement extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'achievements';
    protected $fillable = [
        'title',
        'description',
        'points',
        'image',
        'type',
        'rarity',
        'status',
    ];
    protected $auditInclude = [
        'title',
        'description',
        'points',
        'image',
        'type',
        'rarity',
        'status',
    ];
}
