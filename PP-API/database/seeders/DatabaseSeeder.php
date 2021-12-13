<?php

namespace Database\Seeders;

use App\Models\ProfilerAcademic;
use App\Models\ProfilerContract;
use App\Models\ProfilerEmail;
use App\Models\ProfilerExp;
use App\Models\ProfilerInfo;
use App\Models\ProfilerIp;
use App\Models\ProfilerLang;
use App\Models\ProfilerMedical;
use App\Models\ProfilerProject;
use App\Models\ProfilerResident;
use App\Models\ProfilerSkill;
use App\Models\ProfilerTelephone;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        ProfilerInfo::factory(10)->create();
        ProfilerContract::factory(10)->create();
        User::factory(10)->create();
        ProfilerAcademic::factory(10)->create();
        ProfilerEmail::factory(10)->create();
        ProfilerExp::factory(10)->create();
        ProfilerIp::factory(5)->create();
        ProfilerLang::factory(2)->create();
        ProfilerMedical::factory(10)->create();
        ProfilerProject::factory(10)->create();
        ProfilerResident::factory(10)->create();
        ProfilerSkill::factory(20)->create();
        ProfilerTelephone::factory(10)->create();
    }
}
