<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilerProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_projects';

    protected $attributes = [
        'project_title',
        'project_link',
        'project_description',
        'profiler_infos_id',
        'created_at',
        'updated_at',
        'started_on',
        'finished_on',
    ];

    protected $fillable = [
        'project_title',
        'project_link',
        'project_description',
        'profiler_infos_id',
        'started_on',
        'finished_on',
    ];

    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profilerInfos(): BelongsTo
    {
        return $this->belongsTo(profilerInfo::class);
    }
}
