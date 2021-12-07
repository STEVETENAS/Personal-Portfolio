<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilerInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'profiler_infos';

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'place_of_birth',
        'date_of_birth',
        'profession',
        'place_of_origin',
        'number_of_children',
        'married',
        'profiler_image',
        'background_image',
    ];

    protected $casts = [
        'created_at' => 'datetime:U',
        'updated_at' => 'datetime:U',
        'deleted_at' => 'datetime:U',
    ];

    public function profilerAcademic(): HasMany
    {
        return $this->hasMany(profilerAcademic::class);
    }

    public function profilerContract(): HasMany
    {
        return $this->hasMany(profilerContract::class);
    }

    public function profilerEmail(): HasMany
    {
        return $this->hasMany(profilerEmail::class);
    }

    public function profilerExp(): HasMany
    {
        return $this->hasMany(profilerExp::class);
    }

    public function profilerIps(): HasMany
    {
        return $this->hasMany(profilerIp::class);
    }

    public function profilerLang(): HasMany
    {
        return $this->hasMany(profilerLang::class);
    }

    public function profilerMedical(): HasMany
    {
        return $this->hasMany(profilerMedical::class);
    }

    public function profilerProject(): HasMany
    {
        return $this->hasMany(profilerProject::class);
    }

    public function profilerResident(): HasMany
    {
        return $this->hasMany(profilerResident::class);
    }

    public function profilerSkill(): HasMany
    {
        return $this->hasMany(profilerSkill::class);
    }

    public function profilerTelephone(): HasMany
    {
        return $this->hasMany(profilerTelephone::class);
    }
}
