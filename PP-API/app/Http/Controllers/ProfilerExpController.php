<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerExp;
use App\Http\Requests\UpdateProfilerExp;
use App\Http\Resources\profilerExpResource;
use App\Models\ProfilerExp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerExpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerExp::query();
        $expAttributes = (new profilerExp)->expAttributes();
        return profilerExpResource::collection(IndexFilter::filter($expAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfilerExp $request
     * @return profilerExpResource
     * @throws Exception
     */
    public function store(StoreprofilerExp $request): profilerExpResource
    {
        $exp = profilerExp::create($request->all());
        if ($exp) {
            return new profilerExpResource($exp);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerExpResource
     */
    public function show($id): JsonResponse|profilerExpResource
    {
        $exp = profilerExp::find($id);
        if (!$exp) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerExpResource::make($exp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfilerExp $request
     * @param int $id
     * @return profilerExpResource
     * @throws Exception
     */
    public function update(UpdateprofilerExp $request, $id): profilerExpResource
    {
        $exp = profilerExp::find($id);
        if ($exp->update($request->all())) {
            $exp->flash();
            return new profilerExpResource($exp);
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
        $exp = profilerExp::find($id);
        if ($exp->delete()) {
            return ['Deleted-data' => $exp->id];
        }
        throw new Exception('Unexpected Error');
    }
}
