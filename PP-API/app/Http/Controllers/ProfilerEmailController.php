<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerEmail;
use App\Http\Requests\UpdateProfilerEmail;
use App\Http\Resources\profilerEmailResource;
use App\Models\ProfilerEmail;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerEmail::query();
        $size = $request->query('size');
        $emails = $query->get();
        if ($size) {
            $emails = $query->paginate($size);
        }
        return profilerEmailResource::collection($emails);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProfilerEmail $request
     * @return profilerEmailResource
     * @throws Exception
     */
    public function store(StoreProfilerEmail $request): profilerEmailResource
    {
        $email = profilerEmail::create($request->all());
        if ($email) {
            return new profilerEmailResource($email);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerEmailResource
     */
    public function show($id): JsonResponse|profilerEmailResource
    {
        $email = profilerEmail::find($id);
        if (!$email) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerEmailResource::make($email);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProfilerEmail $request
     * @param int $id
     * @return profilerEmailResource
     * @throws Exception
     */
    public function update(UpdateProfilerEmail $request, $id): profilerEmailResource
    {
        $email = profilerEmail::find($id);
        if ($email->update($request->all())) {
            $email->flash();
            return new profilerEmailResource($email);
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
        $email = profilerEmail::find($id);
        if ($email->delete()) {
            return ['data' => $email->id];
        }
        throw new Exception('Unexpected Error');
    }
}
