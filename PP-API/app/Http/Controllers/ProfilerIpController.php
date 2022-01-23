<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilerIpRequest;
use App\Http\Resources\profilerIpResource;
use App\Models\ProfilerIp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\File;
use JetBrains\PhpStorm\ArrayShape;
use Mosquitto\Exception;

class ProfilerIpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $query = profilerIp::query();
        $ipAttributes = (new ProfilerIp)->ipAttributes();
        return profilerIpResource::collection(IndexFilter::filter($ipAttributes, $query, $request));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProfilerIpRequest $request
     * @return profilerIpResource
     * @throws Exception
     */
    public function store(ProfilerIpRequest $request): profilerIpResource
    {
        $input = $request->all();

        if ($request->hasFile('ip_img')) {
            $ipImageName = $request->file('ip_img')?->getClientOriginalName();
            $ipImagePath = "images/ip_img/" . time() . -uniqid('', false) . '/';
            $request->file('ip_img')?->move($ipImagePath, $ipImageName);
            $input['ip_img'] = $ipImagePath . $ipImageName;
        }

        $ip = new profilerIp($input);
        if (!$ip->save()) {
            throw new Exception('Unexpected Error');
        }
        return new profilerIpResource($ip);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerIpResource
     */
    public function show(int $id): JsonResponse|profilerIpResource
    {
        $ip = profilerIp::query()->find($id);
        if (!$ip) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerIpResource::make($ip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProfilerIpRequest $request
     * @param int $id
     * @return profilerIpResource
     * @throws Exception
     */
    public function update(ProfilerIpRequest $request, int $id): profilerIpResource
    {
        $input = ProfilerIp::query()->find($id);

        $ip = new profilerIp($input);
        if (!$request->hasFile('ip_img')) {
            if (File::exists($ip['ip_img'])) {
                File::delete($ip['ip_img']);
            }
            $ipImageName = $request->file('ip_img') ? $request->file('ip_img')->getClientOriginalName() : null;
            $ipImagePath = "images/ip_img/" . time() . -uniqid('', false) . '/';
            $request->file('ip_img')->move($ipImagePath, $ipImageName);
            $input['ip_img'] = $ipImagePath . $ipImageName;
        }

        if (!$ip->update($request->all())) {
            throw new Exception('Unexpected Error');
        }
        $ip->refresh();
        return new profilerIpResource($ip);
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
        $ip = profilerIp::query()->find($id);
        if (File::exists($ip['ip_img'])) {
            File::delete($ip['ip_img']);
        }
        if (!$ip->delete()) {
            throw new Exception('Unexpected Error');
        }
        return ['Deleted-data' => $ip];
    }
}
