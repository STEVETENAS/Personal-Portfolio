<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerContractRequest;
use App\Http\Resources\profilerContractResource;
use App\Models\ProfilerContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerContract::query();
        $contractAttributes = (new profilerContract)->contractAttributes();
        return profilerContractResource::collection(IndexFilter::filter($contractAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerContractRequest $request
     * @return profilerContractResource
     * @throws Exception
     */
    public function store(ProfilerContractRequest $request): profilerContractResource
    {
        $contract = new profilerContract($request->all());
        if (!$contract->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerContractResource($contract);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerContractResource
     */
    public function show(int $id): JsonResponse|profilerContractResource
    {
        $contract = profilerContract::query()->find($id);
        if (!$contract) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerContractResource::make($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerContractRequest $request
     * @param int $id
     * @return profilerContractResource
     * @throws Exception
     */
    public function update(ProfilerContractRequest $request, int $id): profilerContractResource
    {
        $contract = profilerContract::query()->find($id);
        if (!$contract->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $contract->refresh();
        return new profilerContractResource($contract);
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
        $contract = profilerContract::query()->find($id);
        if (!$contract->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $contract];
    }
}
