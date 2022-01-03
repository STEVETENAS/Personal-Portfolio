<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerProjectRequest;
use App\Http\Resources\profilerProjectResource;
use App\Models\ProfilerProject;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerProject::query();
        $projectAttributes = (new profilerProject)->projectAttributes();
        return profilerProjectResource::collection(IndexFilter::filter($projectAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerProjectRequest $request
     * @return profilerProjectResource
     * @throws Exception
     */
    public function store(ProfilerProjectRequest $request): profilerProjectResource
    {
        $project = new profilerProject($request->all());
        if (!$project->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerProjectResource($project);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerProjectResource
     */
    public function show(int $id): JsonResponse|profilerProjectResource
    {
        $project = profilerProject::query()->find($id);
        if (!$project) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerProjectResource::make($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerProjectRequest $request
     * @param int $id
     * @return profilerProjectResource
     * @throws Exception
     */
    public function update(ProfilerProjectRequest $request, int $id): profilerProjectResource
    {
        $project = profilerProject::query()->find($id);
        if ($project->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $project->refresh();
        return new profilerProjectResource($project);
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
        $project = profilerProject::query()->find($id);
        if (!$project->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $project];
    }
}
