<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerExpRequest;
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
     * @param ProfilerExpRequest $request
     * @return profilerExpResource
     * @throws Exception
     */
    public function store(ProfilerExpRequest $request): profilerExpResource
    {
        $exp = new ProfilerExp($request->all());
        if (!$exp->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerExpResource($exp);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerExpResource
     */
    public function show(int $id): JsonResponse|profilerExpResource
    {
        $exp = profilerExp::query()->find($id);
        if (!$exp) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerExpResource::make($exp);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerExpRequest $request
     * @param int $id
     * @return profilerExpResource
     * @throws Exception
     */
    public function update(ProfilerExpRequest $request, int $id): profilerExpResource
    {
        $exp = profilerExp::query()->find($id);
        if ($exp->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $exp->refresh();
        return new profilerExpResource($exp);
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
        $exp = profilerExp::query()->find($id);
        if ($exp->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $exp];
    }
}
