<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleSalesGetRequest;
use App\Http\Requests\VehicleSalesPostRequest;
use App\Http\Resources\SaleByVehicleResource;
use App\Http\Resources\VehicleSalesResource;
use App\Services\VehicleSaleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleSalesController extends Controller
{
    protected $saleService;

    public function __construct(VehicleSaleService $saleService)
    {
        $this->saleService = $saleService;
    }

    public function index(VehicleSalesGetRequest $request) : JsonResponse
    {
        try {
            $input = $request->all();
            $sales = $this->saleService->listSales($input);
            $response = VehicleSalesResource::collection($sales);
            return response()->json([
                'success' => true,
                'data'    => $response,
            ], Response::HTTP_OK);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'data'    => $err->getMessage(),
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function listSaleByVehicle(string $id) : JsonResponse
    {
        try {
            $vehicleSales = $this->saleService->listSaleByVehicles($id);
            $response = new SaleByVehicleResource($vehicleSales);
            return response()->json([
                'success' => true,
                'data'    => $response,
            ], Response::HTTP_OK);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'data'    => $err->getMessage(),
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function store(VehicleSalesPostRequest $request) : JsonResponse
    {
        try {
            $input = $request->all();
            $sales = $this->saleService->postSales($input);
            $response = new VehicleSalesResource($sales);
            return response()->json([
                'success' => true,
                'data'    => $response
            ], Response::HTTP_OK);
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'data'    => $err->getMessage(),
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
