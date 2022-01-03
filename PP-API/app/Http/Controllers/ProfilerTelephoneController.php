<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerTelephoneRequest;
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
     * @param ProfilerTelephoneRequest $request
     * @return profilerTelephoneResource
     * @throws Exception
     */
    public function store(ProfilerTelephoneRequest $request): profilerTelephoneResource
    {
        $telephone = new profilerTelephone($request->all());
        if (!$telephone->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerTelephoneResource($telephone);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerTelephoneResource
     */
    public function show(int $id): JsonResponse|profilerTelephoneResource
    {
        $telephone = profilerTelephone::query()->find($id);
        if (!$telephone) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerTelephoneResource::make($telephone);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerTelephoneRequest $request
     * @param int $id
     * @return profilerTelephoneResource
     * @throws Exception
     */
    public function update(ProfilerTelephoneRequest $request, int $id): profilerTelephoneResource
    {
        $telephone = profilerTelephone::query()->find($id);
        if (!$telephone->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $telephone->refresh();
        return new profilerTelephoneResource($telephone);
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
        $telephone = profilerTelephone::query()->find($id);
        if (!$telephone->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $telephone];
    }
}
