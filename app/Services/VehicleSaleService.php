<?php

namespace App\Services;

use App\Repositories\VehicleRepository;
use App\Repositories\VehicleSalesRepository;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use Illuminate\Database\Eloquent\Collection;

class VehicleSaleService
{

  protected $session, $salesRepository, $vehicleRepository;


  /**
   * Create a new services instance.
   *
   * @return void
   */
  public function __construct(VehicleSalesRepository $salesRepository, VehicleRepository $vehicleRepository)
  {
    $this->session = DB::getMongoClient()->startSession();
    $this->salesRepository = $salesRepository;
    $this->vehicleRepository = $vehicleRepository;
  }

  /**
   * It checks if the quantity of the item is greater than the quantity of the item in the database, if
   * it is, it throws an exception, if not, it decrements the quantity of the item in the database and
   * creates a new sale
   * 
   * @param array data array of data to be submitted
   * 
   * @return object The return value is an object.
   */
  public function postSales(array $data): object
  {
    $this->session->startTransaction();
    try {
      $vehicle = $this->vehicleRepository->findById($data['vehicle_id']);
      $postData = [
        'vehicle_id'    => $vehicle->id,
        'qty'           => $data['qty'],
      ];
      $vehicleType = $vehicle->vehicles()->first();

      // CHECKING QUANTITY
      if ($data['qty'] > $vehicleType->qty) {
        throw new InvalidArgumentException('Insufficient Stock');
      }

      $vehicleType->decrement('qty', $data['qty']);

      $created = $this->salesRepository->submitSale($postData);
    } catch (\Exception $err) {
      $this->session->abortTransaction();
      throw new InvalidArgumentException($err->getMessage());
    }
    $this->session->commitTransaction();
    return $created->load('vehicle');
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
    $sales = $this->salesRepository->listSales($data);
    return $sales;
  }

  /**
   * It returns a vehicle data by id and get all sales data
   * 
   * @param array data
   * 
   * @return object vehicles and array of sales.
   */
  public function listSaleByVehicles(string $id): object
  {
    $vehicleSales = $this->salesRepository->listSalesByVehicles($id);
    return $vehicleSales;
  }
}
