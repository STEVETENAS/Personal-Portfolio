<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerContract;
use App\Http\Requests\UpdateProfilerContract;
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
     * @param StoreProfilerContract $request
     * @return profilerContractResource
     * @throws Exception
     */
    public function store(StoreprofilerContract $request): profilerContractResource
    {
        $contract = profilerContract::create($request->all());
        if ($contract) {
            return new profilerContractResource($contract);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerContractResource
     */
    public function show($id): JsonResponse|profilerContractResource
    {
        $contract = profilerContract::find($id);
        if (!$contract) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerContractResource::make($contract);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfilerContract $request
     * @param int $id
     * @return profilerContractResource
     * @throws Exception
     */
    public function update(UpdateProfilerContract $request, $id): profilerContractResource
    {
        $contract = profilerContract::find($id);
        if ($contract->update($request->all())) {
            $contract->flash();
            return new profilerContractResource($contract);
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
        $contract = profilerContract::find($id);
        if ($contract->delete()) {
            return ['Deleted-data' => $contract->id];
        }
        throw new Exception('Unexpected Error');
    }
}
