<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerEmailRequest;
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
        $query = ProfilerEmail::query();
        $emailAttributes = (new ProfilerEmail)->emailAttributes();
        return profilerEmailResource::collection(IndexFilter::filter($emailAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerEmailRequest $request
     * @return profilerEmailResource
     * @throws Exception
     */
    public function store(ProfilerEmailRequest $request): profilerEmailResource
    {
        $email = new profilerEmail($request->all());
        if (!$email->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerEmailResource($email);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerEmailResource
     */
    public function show(int $id): JsonResponse|profilerEmailResource
    {
        $email = profilerEmail::query()->find($id);
        if (!$email) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerEmailResource::make($email);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerEmailRequest $request
     * @param int $id
     * @return profilerEmailResource
     * @throws Exception
     */
    public function update(ProfilerEmailRequest $request, int $id): profilerEmailResource
    {
        $email = profilerEmail::query()->find($id);
        if (!$email->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $email->refresh();
        return new profilerEmailResource($email);
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
        $email = profilerEmail::query()->find($id);
        if (!$email->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $email];
    }
}
