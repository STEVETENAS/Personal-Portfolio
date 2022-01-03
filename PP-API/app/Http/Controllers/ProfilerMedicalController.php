<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerMedicalRequest;
use App\Http\Resources\profilerMedicalResource;
use App\Models\ProfilerMedical;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerMedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerMedical::query();
        $medicalAttributes = (new profilerMedical)->medicalAttributes();
        return profilerMedicalResource::collection(IndexFilter::filter($medicalAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerMedicalRequest $request
     * @return profilerMedicalResource
     * @throws Exception
     */
    public function store(ProfilerMedicalRequest $request): profilerMedicalResource
    {
        $medical = new profilerMedical($request->all());
        if (!$medical->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerMedicalResource($medical);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerMedicalResource
     */
    public function show(int $id): JsonResponse|profilerMedicalResource
    {
        $medical = profilerMedical::query()->find($id);
        if (!$medical) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerMedicalResource::make($medical);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerMedicalRequest $request
     * @param int $id
     * @return profilerMedicalResource
     * @throws Exception
     */
    public function update(ProfilerMedicalRequest $request, int $id): profilerMedicalResource
    {
        $medical = profilerMedical::query()->find($id);
        if (!$medical->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $medical->refresh();
        return new profilerMedicalResource($medical);
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
        $medical = profilerMedical::query()->find($id);
        if (!$medical->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $medical];
    }
}
