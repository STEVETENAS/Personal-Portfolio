<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerInfoRequest;
use App\Http\Resources\profilerInfoResource;
use App\Models\ProfilerInfo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
            $profilerImageName = $request->file('profiler_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('profiler_image'));
            $date = date('Y-m-d');
            $unique = uniqid('', true);
            $profilerImagePath = "public/images/profiler_images/$date-$unique-$width-$height";
            $input['profiler_image'] = $request->file('profiler_image')->storeAs($profilerImagePath, $profilerImageName);
        }

        if ($request->hasFile('background_image')) {
            $bgImageName = $request->file('background_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('background_image'));
            $date = date('Y-m-d');
            $unique = uniqid('', true);
            $bgImagePath = "public/images/bg_images/$date-$unique-$width-$height";
            $input['background_image'] = $request->file('background_image')->storeAs($bgImagePath, $bgImageName);
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
        $input = $request->all();
        if ($request->hasFile('profiler_image')) {
            $profilerImageName = $request->file('profiler_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('profiler_image'));
            $date = date('Y-m-d');
            $unique = uniqid('', true);
            $profilerImagePath = "images/profiler_images/$date-$profilerImageName-$unique-$width-$height";
            $input['profiler_image'] = $request->file('profiler_image')->storeAs($profilerImagePath, $profilerImageName);
        }

        if ($request->hasFile('background_image')) {
            $bgImageName = $request->file('background_image')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('background_image'));
            $date = date('Y-m-d');
            $unique = uniqid('', true);
            $bgImagePath = "images/bg_images/$date-$bgImageName-$unique-$width-$height";
            $input['background_image'] = $request->file('background_image')->storeAs($bgImagePath, $bgImageName);
        }

        $info = profilerInfo::query()->find($id);
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
