<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerResidentRequest;
use App\Http\Resources\profilerResidentResource;
use App\Models\ProfilerResident;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerResident::query();
        $residentAttributes = (new profilerResident)->residentAttributes();
        return profilerResidentResource::collection(IndexFilter::filter($residentAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerResidentRequest $request
     * @return profilerResidentResource
     * @throws Exception
     */
    public function store(ProfilerResidentRequest $request): profilerResidentResource
    {
        $resident = new profilerResident($request->all());
        if (!$resident->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerResidentResource($resident);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerResidentResource
     */
    public function show(int $id): JsonResponse|profilerResidentResource
    {
        $resident = profilerResident::query()->find($id);
        if (!$resident) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerResidentResource::make($resident);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerResidentRequest $request
     * @param int $id
     * @return profilerResidentResource
     * @throws Exception
     */
    public function update(ProfilerResidentRequest $request, int $id): profilerResidentResource
    {
        $resident = profilerResident::query()->find($id);
        if ($resident->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $resident->refresh();
        return new profilerResidentResource($resident);
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
        $resident = profilerResident::query()->find($id);
        if (!$resident->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $resident];
    }
}
