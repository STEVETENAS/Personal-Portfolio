<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilerIp extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_ips';

    protected $fillable = [
        'ip_name',
        'ip_description',
        'ip_img',
        'profiler_info_id',
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

    public function ipAttributes(): array
    {
        return [
            'ip_name',
            'ip_description',
            'profiler_info_id',
            'created_at',
            'updated_at',
        ];
    }
}
