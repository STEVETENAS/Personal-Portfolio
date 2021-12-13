<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerProject;
use App\Http\Requests\UpdateProfilerProject;
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
        $projectAttributes = (new profilerProject)->attributesToArray();
        return profilerProjectResource::collection(IndexFilter::filter($projectAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilerProject $request
     * @return profilerProjectResource
     * @throws Exception
     */
    public function store(StoreprofilerProject $request): profilerProjectResource
    {
        $project = profilerProject::create($request->all());
        if ($project) {
            return new profilerProjectResource($project);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerProjectResource
     */
    public function show($id): JsonResponse|profilerProjectResource
    {
        $project = profilerProject::find($id);
        if (!$project) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerProjectResource::make($project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerProject $request
     * @param int $id
     * @return profilerProjectResource
     * @throws Exception
     */
    public function update(UpdateprofilerProject $request, $id): profilerProjectResource
    {
        $project = profilerProject::find($id);
        if ($project->update($request->all())) {
            $project->flash();
            return new profilerProjectResource($project);
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
        $project = profilerProject::find($id);
        if ($project->delete()) {
            return ['Deleted-data' => $project->id];
        }
        throw new Exception('Unexpected Error');
    }
}
