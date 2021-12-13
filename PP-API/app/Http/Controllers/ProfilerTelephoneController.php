<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerTelephone;
use App\Http\Requests\UpdateProfilerTelephone;
use App\Http\Resources\profilerTelephoneResource;
use App\Models\ProfilerTelephone;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerTelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerTelephone::query();
        $telephoneAttributes = (new profilerTelephone)->telephoneAttributes();
        return profilerTelephoneResource::collection(IndexFilter::filter($telephoneAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreprofilerTelephone $request
     * @return profilerTelephoneResource
     * @throws Exception
     */
    public function store(StoreprofilerTelephone $request): profilerTelephoneResource
    {
        $telephone = profilerTelephone::create($request->all());
        if ($telephone) {
            return new profilerTelephoneResource($telephone);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerTelephoneResource
     */
    public function show($id): JsonResponse|profilerTelephoneResource
    {
        $telephone = profilerTelephone::find($id);
        if (!$telephone) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerTelephoneResource::make($telephone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerTelephone $request
     * @param int $id
     * @return profilerTelephoneResource
     * @throws Exception
     */
    public function update(UpdateprofilerTelephone $request, $id): profilerTelephoneResource
    {
        $telephone = profilerTelephone::find($id);
        if ($telephone->update($request->all())) {
            $telephone->flash();
            return new profilerTelephoneResource($telephone);
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
        $telephone = profilerTelephone::find($id);
        if ($telephone->delete()) {
            return ['Deleted-data' => $telephone->id];
        }
        throw new Exception('Unexpected Error');
    }
}
