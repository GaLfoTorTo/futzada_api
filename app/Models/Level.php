<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Level extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'levels';
    protected $fillable = [
        "number",
        "tier",
        "title",
        "points_min",
        "points_max",
        "image",
        "color",
    ];
    protected $auditInclude = [
        "number",
        "tier",
        "title",
        "points_min",
        "points_max",
        "image",
        "color",
    ];
}
