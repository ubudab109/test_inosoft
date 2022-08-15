<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
use Illuminate\Database\Eloquent\Collection;


class VehicleService
{

  protected $vehicleRepository;

  /**
   * Create a new services instance.
   *
   * @return void
   */
  public function __construct(VehicleRepository $vehicleRepository)
  {
    $this->vehicleRepository = $vehicleRepository;
  }

  /**
   * It gets all the vehicles from the database
   * 
   * @param array data
   * 
   * @return Collection of vehicles.
   */
  public function getAll(array $data): Collection
  {
    $vehicles = $this->vehicleRepository->getAll($data);
    return $vehicles;
  }

  /**
   * It takes a string as an argument, and returns an object
   * 
   * @param string id The id of the vehicle to find
   * 
   * @return object An object
   */
  public function findById(string $id): object
  {
    $vehicle = $this->vehicleRepository->findById($id);
    return $vehicle;
  }
}
