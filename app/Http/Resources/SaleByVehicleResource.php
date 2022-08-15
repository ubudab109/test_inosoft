<?php

namespace App\Http\Resources;

use App\Models\Car;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleByVehicleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dataSales = parent::toArray($request)['sales'];
        $vehicleType = $this->source;
        $vehicleDataArr = [
            'machine'   => $vehicleType->machine,
            'stock'     => $vehicleType->qty,

        ];

        if ($this->source_type == Car::class) {
            $vehicleDataArr['passenger_capacity'] = $vehicleType->passenger_capacity;
            $vehicleDataArr['type'] = $vehicleType->type;
        } else if ($this->source_type == Motorcycle::class) {
            $vehicleDataArr['suspension_type'] = $vehicleType->suspension_type;
            $vehicleDataArr['transmision_type'] = $vehicleType->transmision_type;
        } else {
            $vehicleDataArr = [];
        }

        return [
            'id'            => $this->id,
            'price'         => $this->price,
            'years'         => $this->years,
            'color'         => $this->color,
            'vehicle_data'  => $vehicleDataArr,
            'sales'         => $dataSales,
        ];
    }
}
