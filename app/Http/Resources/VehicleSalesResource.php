<?php

namespace App\Http\Resources;

use App\Models\Car;
use App\Models\Motorcycle;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleSalesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $vehicleData = $this->vehicle;
        $vehicleType = $vehicleData->vehicles;
        $vehicleDataArr = [
            'machine'   => $vehicleType->machine,
        ];

        if ($vehicleData->source_type == Car::class) {
            $vehicleDataArr['passenger_capacity'] = $vehicleType->passenger_capacity;
            $vehicleDataArr['type'] = $vehicleType->type;
        } else if ($vehicleData->source_type == Motorcycle::class) {
            $vehicleDataArr['suspension_type'] = $vehicleType->suspension_type;
            $vehicleDataArr['transmision_type'] = $vehicleType->transmision_type;
        } else {
            $vehicleDataArr = [];
        }

        return [
            'id'                  => $this->id,
            'total_price'         => $vehicleData->price * $this->qty,
            'current_stock'       => $vehicleType->qty,
            'vehicle'             => [
                'years'           => $vehicleData->years,
                'price'           => $vehicleData->price,
                'color'           => $vehicleData->color,
                'vehicle_data'    => $vehicleDataArr,
            ]
        ];
    }
}
