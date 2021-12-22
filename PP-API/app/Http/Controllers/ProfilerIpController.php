<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfilerIp;
use App\Http\Requests\UpdateProfilerIp;
use App\Http\Resources\profilerIpResource;
use App\Models\ProfilerIp;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
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
     * @param StoreprofilerIp $request
     * @return profilerIpResource
     * @throws Exception
     */
    public function store(StoreProfilerIp $request): profilerIpResource
    {
        $input = $request->all();

        if ($request->hasFile('ip_img')) {
            $ipImageName = $request->file('ip_img')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('ip_img'));
            $date = date('Y-m-d');
            $id = uniqid('', true);
            $ipImagePath = "public/images/ips_images/{$date}-{$id}-{$width}-{$height}";
            $input['ip_img'] = $request->file('ip_img')->storeAs($ipImagePath,$ipImageName);
        }

        $ip = profilerIp::create($input);
        if ($ip) {
            return new profilerIpResource($ip);
        }
        throw new Exception('Unexpected Error');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse|profilerIpResource
     */
    public function show($id): JsonResponse|profilerIpResource
    {
        $ip = profilerIp::find($id);
        if (!$ip) {
            return response()->json(['error' => 'Unrecognised ID'], 400);
        }
        return profilerIpResource::make($ip);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateprofilerIp $request
     * @param int $id
     * @return profilerIpResource
     * @throws Exception
     */
    public function update(UpdateprofilerIp $request, $id): profilerIpResource
    {
        $input = $request->all();

        if ($request->hasFile('ip_img')) {
            $ipImageName = $request->file('ip_img')->getClientOriginalName();
            [$width, $height] = getimagesize($request->file('ip_img'));
            $date = date('Y-m-d');
            $id = uniqid('', true);
            $ipImagePath = "images/ips_images/{$date}-{$ipImageName}-{$id}-{$width}-{$height}";
            $input['ip_img'] = $request->file('ip_img')->store($ipImagePath);
        }

        $ip = profilerIp::create($input);
        if ($ip->update($request->all())) {
            $ip->flash();
            return new profilerIpResource($ip);
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
        $ip = profilerIp::find($id);
        if ($ip->delete()) {
            return ['Deleted-data' => $ip->id];
        }
        throw new Exception('Unexpected Error');
    }
}
//$query = profilerIp::query();
//$size = $request->query('size');
//$ips = $query->get();
//if ($request->query('id')) {
//    $ips = profilerIp::find($request->query('id'));
//}
//if ($request->query('ip_name')) {
//    $ips = $query
//        ->where('ip_name', 'like','%'.$request->query('ip_name').'%')
//        ->get();
//}
//if ($request->query('ip_description')) {
//    $ips = $query
//        ->where('ip_description', 'like','%'.$request->query('ip_description').'%')
//        ->get();
//}
//if ($request->query('profiler_infos_id')) {
//    $ips = $query
//        ->where('profiler_infos_id', 'like',$request->query('profiler_infos_id'))
//        ->get();
//}
//if ($request->query('created_at')) {
//    $ips = $query
//        ->where('created_at', 'like','%'.$request->query('created_at').'%')
//        ->get();
//}
//if ($request->query('updated_at')) {
//    $ips = $query
//        ->where('updated_at', 'like','%'.$request->query('updated_at').'%')
//        ->get();
//}
//if ($size) {
//    $ips = $query->paginate($size);
//}
//return profilerIpResource::collection($ips);
