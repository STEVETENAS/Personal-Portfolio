<?php

namespace App\Http\Controllers;

class IndexFilter extends Controller
{
    public static function filter($attributes, $modelQuery, $request)
    {
        $size = $request->query('size');
        $res = $modelQuery->get();

        foreach ($attributes as $p) {
            if ($request->query($p)) {
                $res = $modelQuery
                    ->where($p, 'like', '%' . $request->query($p) . '%')
                    ->get();
            }
        }

        if ($request->query('id')) {
            $res = $modelQuery
                ->where('id', 'like', $request->query('id'))
                ->get();
        }

        if ($size) {
            $res = $modelQuery->paginate($size);
        }
        return $res;
    }

//$query = ProfilerAcademic::query();
//$size = $request->query('size');
//$academics = $query->get();
//$profilerAttributes = (new ProfilerAcademic)->attributesToArray();
//
////        foreach ($profilerAttributes as $p){
////            if($request->query($p)){
////                $academics = $query
////                ->where($p, 'like','%'.$request->query($p).'%')
////                ->get();
////            }
////        }
////        if ($size) {
////            $academics = $query->paginate($size);
////        }
//
////        return ProfilerAcademicResource::collection($academics);
//return ProfilerAcademicResource::collection(IndexFilter::filter($profilerAttributes,$query,$request));

}
