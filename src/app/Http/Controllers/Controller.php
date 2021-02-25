<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function toJsonPaginate($data)
    {
        return response()->json(['data' => $data->items(), 'total' => $data->total()]);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    protected function toJson($data)
    {
        return response()->json($data);
    }
}
