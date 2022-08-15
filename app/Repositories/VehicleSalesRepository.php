<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Models\VehicleTransaction;
use DateTime;
use Illuminate\Database\Eloquent\Collection;

class VehicleSalesRepository
{
  /**
   * @var ModelName
   */
  protected $model, $vehicle;

  public function __construct(VehicleTransaction $model, Vehicle $vehicle)
  {
    $this->model = $model;
    $this->vehicle = $vehicle;
  }

  /**
   * Submit sales vehicles
   * 
   * @param array data
   * 
   * @return object for created data.
   */
  public function submitSale(array $data): object
  {
    $data = $this->model->create($data);
    return $data;
  }

  /**
   * It returns data sales from database
   * 
   * @param array data
   * 
   * @return array A collection of all the sales that match the type.
   */
  public function listSales(array $data): Collection
  {
    $data = $this->model->when(isset($data['vehicle_id']) && $data['vehicle_id'] != null, function ($query) use ($data) {
      $query->where('vehicle_id', $data['vehicle_id']);
    })
      ->when(isset($data['date_start']) && isset($data['date_end']), function ($query) use ($data) {
        $query->where('created_at', '>=', new DateTime($data['date_start']))
          ->where('created_at', '<=', new DateTime($data['date_end']));
      })->get();

    return $data;
  }

  /**
   * It returns a vehicle data by id and get all sales data
   * 
   * @param array data
   * 
   * @return object vehicles and array of sales.
   */
  public function listSalesByVehicles(string $vehicleId): object
  {
    $vehicle = $this->vehicle->with('vehicles')->findOrFail($vehicleId);
    $vehicle['sales'] = $this->model->where('vehicle_id', $vehicleId)->get()->makeHidden(['vehicle']);
    return $vehicle;
  }
}
