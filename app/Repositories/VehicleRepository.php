<?php

namespace App\Repositories;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Collection;

class VehicleRepository
{
    /**
    * @var ModelName
    */
    protected $model;

    public function __construct(Vehicle $model)
    {
      $this->model = $model;
    }

    /**
     * It returns all the records from the database, but if the type is 0, it will only return the
     * records where the source_type is Car::class, and if the type is 1, it will only return the
     * records where the source_type is Motorcycle::class
     * 
     * @param array data
     * 
     * @return array A collection of all the vehicles that match the type.
     */
    public function getAll(array $data) : Collection
    {
      $data = $this->model->when(isset($data['type']) && $data['type'] != null, function ($query) use ($data) {
        if ($data['type'] == 0) $query->where('source_type', Car::class);
        if ($data['type'] == 1) $query->where('source_type', Motorcycle::class);
      })->with('vehicles')->get();
      return $data;
    }

    /**
     * It finds a record by its source_id and returns the record with its vehicles
     * 
     * @param string id The id of the source
     * 
     * @return object The first record in the database that matches the source_id.
     */
    public function findById(string $id) : object
    {
      $data = $this->model->with('vehicles')->findOrFail($id);
      return $data;
    }

}