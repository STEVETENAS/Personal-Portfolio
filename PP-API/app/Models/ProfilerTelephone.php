<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilerTelephone extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_telephones';

    protected $attributes = [
        'profiler_phone_number',
        'phone_number_description',
        'profiler_infos_id',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'profiler_phone_number',
        'phone_number_description',
        'profiler_infos_id',
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
