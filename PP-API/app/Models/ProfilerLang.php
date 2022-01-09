<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilerLang extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_langs';

    protected $fillable = [
        'language',
        'language_level',
        'profiler_info_id',
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

    public function langAttributes(): array
    {
        return [
            'language',
            'language_level',
            'profiler_info_id',
            'created_at',
            'updated_at',
        ];
    }
}
