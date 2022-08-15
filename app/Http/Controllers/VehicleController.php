<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleRequest;
use App\Http\Resources\VehicleResource;
use App\Services\VehicleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class VehicleController extends Controller
{

    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }
    
    /**
     * It gets all the vehicles from the database and returns them as a JSON response
     * 
     * @param VehicleRequest request The request object.
     * 
     * @return JsonResponse A collection of vehicles
     */
    public function index(VehicleRequest $request) : JsonResponse
    {
        try {
            $input = $request->all();
            $vehicle = $this->vehicleService->getAll($input);
            $response = VehicleResource::collection($vehicle);
            return response()->json($response, Response::HTTP_OK);
        } catch (\Exception $err) {
            return response()->json([],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * It returns a JSON response of a vehicle resource
     * 
     * @param string id The id of the vehicle to be retrieved.
     * 
     * @return JsonResponse A JsonResponse object.
     */
    public function detail(string $id) : JsonResponse
    {
        $vehicle = $this->vehicleService->findById($id);
        $response = new VehicleResource($vehicle);
        return response()->json($response, Response::HTTP_OK);
    }
}
