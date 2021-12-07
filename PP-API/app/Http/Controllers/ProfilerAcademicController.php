<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerAcademic;
use App\Http\Requests\UpdateProfilerAcademic;
use App\Http\Resources\ProfilerAcademicResource;
use App\Models\ProfilerAcademic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Mosquitto\Exception;

class ProfilerAcademicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = ProfilerAcademic::query();
        $size = $request->query('size');
        $academics = $query->get();
        if ($size) {
            $academics = $query->paginate($size);
        }
        return ProfilerAcademicResource::collection($academics);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfilerAcademic $request
     * @return profilerAcademicResource
     * @throws Exception
     */
    public function store(StoreProfilerAcademic $request): profilerAcademicResource
    {
        $academic = ProfilerAcademic::create($request->all());
        if ($academic) {
            return new ProfilerAcademicResource($academic);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerAcademicResource
     */
    public function show($id): JsonResponse|profilerAcademicResource
    {
        $academic = ProfilerAcademic::find($id);
        if (!$academic) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return ProfilerAcademicResource::make($academic);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfilerAcademic $request
     * @param int $id
     * @return profilerAcademicResource
     * @throws Exception
     */
    public function update(UpdateProfilerAcademic $request, $id): profilerAcademicResource
    {
        $academic = ProfilerAcademic::find($id);
        if ($academic->update($request->all())) {
            $academic->flash();
            return new ProfilerAcademicResource($academic);
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
    public function destroy($id): array
    {
        $academic = profilerAcademic::find($id);
        if ($academic->delete()) {
            return ['Deleted-data' => $academic->id];
        }
        throw new Exception('Unexpected Error');
    }
}
