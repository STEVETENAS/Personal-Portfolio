<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerSkillRequest;
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
        $skillAttributes = (new profilerSkill)->skillAttributes();
        return profilerSkillResource::collection(IndexFilter::filter($skillAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerSkillRequest $request
     * @return profilerSkillResource
     * @throws Exception
     */
    public function store(ProfilerSkillRequest $request): profilerSkillResource
    {
        $skill = new profilerSkill($request->all());
        if (!$skill->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerSkillResource($skill);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerSkillResource
     */
    public function show(int $id): JsonResponse|profilerSkillResource
    {
        $skill = profilerSkill::query()->find($id);
        if (!$skill) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerSkillResource::make($skill);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerSkillRequest $request
     * @param int $id
     * @return profilerSkillResource
     * @throws Exception
     */
    public function update(ProfilerSkillRequest $request, int $id): profilerSkillResource
    {
        $skill = profilerSkill::query()->find($id);
        if (!$skill->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $skill->refresh();
        return new profilerSkillResource($skill);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    #[ArrayShape(['Deleted-data' => "mixed"])]
    public function destroy(int $id): array
    {
        $skill = profilerSkill::query()->find($id);
        if (!$skill->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $skill];
    }
}
