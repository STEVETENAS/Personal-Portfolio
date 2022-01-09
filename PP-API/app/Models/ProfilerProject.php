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

    protected $fillable = [
        'project_title',
        'project_link',
        'project_description',
        'profiler_info_id',
        'started_on',
        'finished_on',
    ];

    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profilerInfo(): BelongsTo
    {
        return $this->belongsTo(profilerInfo::class);
    }

    public function projectAttributes(): array
    {
        return [
            'project_title',
            'project_link',
            'project_description',
            'profiler_info_id',
            'created_at',
            'updated_at',
            'started_on',
            'finished_on',
        ];
    }

}
