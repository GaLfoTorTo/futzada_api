<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;
use App\Models\User;
use App\Models\Escalacao;

class Manager extends Model implements Auditable
{
    use HasFactory, SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'managers';
    protected $fillable = [
        'user_id',
        'team',
        'alias',
        'primary',
        'secondary',
        'emblem',
        'uniform',
    ];
    protected $auditInclude = [
        'user_id',
        'team',
        'alias',
        'primary',
        'secondary',
        'emblem',
        'uniform',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function escalation(){
        return $this->hasMany(Escalation::class);
    }
}
