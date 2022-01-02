<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerAcademic;
use App\Http\Requests\UpdateProfilerAcademic;
use App\Http\Resources\ProfilerAcademicResource;
use App\Models\ProfilerAcademic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Exception;

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
        $profilerAttributes = (new ProfilerAcademic)->academicAttributes();

        return ProfilerAcademicResource::collection(IndexFilter::filter($profilerAttributes, $query, $request));
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
        $academic = new ProfilerAcademic($request->all());
        if (! $academic->save()) {
            throw new Exception('Unexpected Error');
        }

        return new ProfilerAcademicResource($academic);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerAcademicResource
     */
    public function show(int $id): JsonResponse|profilerAcademicResource
    {
        $academic = ProfilerAcademic::query()->find($id);
        if (! $academic) {
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
    public function update(UpdateProfilerAcademic $request, int $id): profilerAcademicResource
    {
        $academic = ProfilerAcademic::query()->find($id);
        if (! $academic->update($request->all())) {
            throw new Exception('Unexpected Error');
        }

        $academic->refresh();
        return new ProfilerAcademicResource($academic);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return array
     * @throws Exception
     */
    public function destroy(int $id): array
    {
        $academic = profilerAcademic::query()->find($id);
        if (! $academic->delete()) {
            throw new Exception('Unexpected Error');
        }

        return ['Deleted-data' => $academic->id];
    }
}
