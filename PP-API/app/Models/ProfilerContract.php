<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilerContract extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_contracts';

    protected $fillable = [
        'contract_type',
        'contract_description',
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

    public function contractAttributes(): array
    {
        return [
            'contract_type',
            'contract_description',
            'profiler_info_id',
            'started_on',
            'finished_on',
            'created_at',
            'updated_at',
        ];
    }
}
