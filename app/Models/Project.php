<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'system_pic_id',
        'lead_developer_id',
        'developer_id',
        'startDate',
        'endDate',
        'duration',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class,'owner_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function progress(): HasMany
    {
        return $this->hasMany(Progress::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function developers(): BelongsToMany
   {
        return $this->belongsToMany(User::class,'project_user',  'project_id' ,'user_id')->withTimestamps();
    }
}
