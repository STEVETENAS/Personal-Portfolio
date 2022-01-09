<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerInfoRequest;
use App\Http\Resources\profilerInfoResource;
use App\Models\ProfilerInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\File;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerInfo::query();
        $infoAttributes = (new profilerInfo)->infoAttributes();
        return profilerInfoResource::collection(IndexFilter::filter($infoAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerInfoRequest $request
     * @return profilerInfoResource
     * @throws Exception
     */
    public function store(ProfilerInfoRequest $request): profilerInfoResource
    {
        $input = $request->all();

        if ($request->hasFile('profiler_image')) {
            $profilerImageName = $request->file('profiler_image') ? $request->file('profiler_image')->getClientOriginalName() : null;
            $unique = uniqid('', false);
            $profilerImagePath = "images/profiler_images/" . time() . "-$unique/";
            $request->file('profiler_image')->move($profilerImagePath, $profilerImageName);
            $input['profiler_image'] = $profilerImagePath . $profilerImageName;
        }

        if ($request->hasFile('background_image')) {
            $bgImageName = $request->file('background_image') ? $request->file('background_image')->getClientOriginalName() : null;
            $unique = uniqid('', false);
            $bgImagePath = "images/bg_images/" . time() . "-$unique/";
            $request->file('background_image')->move($bgImagePath, $bgImageName);
            $input['background_image'] = $bgImagePath . $bgImageName;
        }

        $info = new profilerInfo($input);
        if (!$info->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerInfoResource($info);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerInfoResource
     */
    public function show(int $id): JsonResponse|profilerInfoResource
    {
        $info = profilerInfo::query()->find($id);
        if (!$info) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerInfoResource::make($info);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerInfoRequest $request
     * @param int $id
     * @return profilerInfoResource
     * @throws Exception
     */
    public function update(ProfilerInfoRequest $request, int $id): profilerInfoResource
    {
        $info = profilerInfo::query()->find($id);
        $input = $request->all();

        if (!$request->hasFile('profiler_image')) {
            if (File::exists($info['profiler_images'])) {
                File::delete($info['profiler_images']);
            }
            $profilerImageName = $request->file('profiler_image') ? $request->file('profiler_image')->getClientOriginalName() : null;
            $unique = uniqid('', false);
            $profilerImagePath = "images/profiler_images/" . time() . "-$unique/";
            $request->file('profiler_image')->move($profilerImagePath, $profilerImageName);
            $input['profiler_image'] = $profilerImagePath . $profilerImageName;
        }

        if ($request->hasFile('background_image')) {
            if (File::exists($info['profiler_images'])) {
                File::delete($info['background_image']);
            }
            $bgImageName = $request->file('background_image') ? $request->file('background_image')->getClientOriginalName() : null;
            $unique = uniqid('', false);
            $bgImagePath = "images/bg_images/" . time() . "-$unique/";
            $request->file('background_image')->move($bgImagePath, $bgImageName);
            $input['background_image'] = $bgImagePath . $bgImageName;
        }

        if (!$info->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $info->refresh();
        return new profilerInfoResource($input);
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
        $info = profilerInfo::query()->find($id);
        if ($info->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $info];
    }
}
