<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerSkill;
use App\Http\Requests\UpdateProfilerSkill;
use App\Http\Resources\profilerSkillResource;
use App\Models\ProfilerSkill;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerSkillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerSkill::query();
        $skillAttributes = (new profilerSkill)->attributesToArray();
        return profilerSkillResource::collection(IndexFilter::filter($skillAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilerSkill $request
     * @return profilerSkillResource
     * @throws Exception
     */
    public function store(StoreprofilerSkill $request): profilerSkillResource
    {
        $skill = profilerSkill::create($request->all());
        if ($skill) {
            return new profilerSkillResource($skill);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerSkillResource
     */
    public function show($id): JsonResponse|profilerSkillResource
    {
        $skill = profilerSkill::find($id);
        if (!$skill) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerSkillResource::make($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerSkill $request
     * @param int $id
     * @return profilerSkillResource
     * @throws Exception
     */
    public function update(UpdateprofilerSkill $request, $id): profilerSkillResource
    {
        $skill = profilerSkill::find($id);
        if ($skill->update($request->all())) {
            $skill->flash();
            return new profilerSkillResource($skill);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['data' => "mixed"])]
    public function destroy($id): array
    {
        $skill = profilerSkill::find($id);
        if ($skill->delete()) {
            return ['Deleted-data' => $skill->id];
        }
        throw new Exception('Unexpected Error');
    }
}
