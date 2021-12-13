<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerMedical;
use App\Http\Requests\UpdateProfilerMedical;
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
        $medicalAttributes = (new profilerMedical)->attributesToArray();
        return profilerMedicalResource::collection(IndexFilter::filter($medicalAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilerMedical $request
     * @return profilerMedicalResource
     * @throws Exception
     */
    public function store(StoreprofilerMedical $request): profilerMedicalResource
    {
        $medical = profilerMedical::create($request->all());
        if ($medical) {
            return new profilerMedicalResource($medical);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerMedicalResource
     */
    public function show($id): JsonResponse|profilerMedicalResource
    {
        $medical = profilerMedical::find($id);
        if (!$medical) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerMedicalResource::make($medical);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerMedical $request
     * @param int $id
     * @return profilerMedicalResource
     * @throws Exception
     */
    public function update(UpdateprofilerMedical $request, $id): profilerMedicalResource
    {
        $medical = profilerMedical::find($id);
        if ($medical->update($request->all())) {
            $medical->flash();
            return new profilerMedicalResource($medical);
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
        $medical = profilerMedical::find($id);
        if ($medical->delete()) {
            return ['Deleted-data' => $medical->id];
        }
        throw new Exception('Unexpected Error');
    }
}
