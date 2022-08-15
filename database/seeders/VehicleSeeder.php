<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $session = DB::getMongoClient()->startSession();
        $session->startTransaction();
        try {

            $carData = [
                [
                    '_id'                        => '62f8b1edd2c0c50678095664',
                    'machine'                   => 'TEST-231',
                    'passenger_capacity'        => 4,
                    'type'                      => 'TOYOTA VIOS',
                    'qty'                       => 10,
                ],
                [
                    '_id'                        => '62f8b1edd2c0c50678095690',
                    'machine'                   => 'TEST-258',
                    'passenger_capacity'        => 4,
                    'type'                      => 'HONDA CIVIC',
                    'qty'                       => 8,
                ],
                [
                    '_id'                        => '62f8b1edd2c0c50988095690',
                    'machine'                   => 'TEST-698',
                    'passenger_capacity'        => 8,
                    'type'                      => 'TOYOTA FORTUNER',
                    'qty'                       => 8,
                ],
            ];

            $carVehiclesData = [
                [
                    'source_id'             => '62f8b1edd2c0c50678095664',
                    'source_type'           => Car::class,
                    'price'                 => 80000000,
                    'years'                 => '2015',
                    'color'                 => 'black',
                ],
                [
                    'source_id'             => '62f8b1edd2c0c50678095690',
                    'source_type'           => Car::class,
                    'price'                 => 850000000,
                    'years'                 => '2020',
                    'color'                 => 'white',
                ],
                [
                    'source_id'             => '62f8b1edd2c0c50988095690',
                    'source_type'           => Car::class,
                    'price'                 => 650000000,
                    'years'                 => '2017',
                    'color'                 => 'black',
                ],
            ];

            $motorcycleData = [
                [
                    '_id'                    => '72f8b1edd2c0c50988095690',
                    'machine'               => 'TSTM-23456',
                    'suspension_type'       => 'Telescopic Fork',
                    'transmision_type'      => 'Automatic',     
                    'qty'                   => 20,
                ],
                [
                    '_id'                    => '79f8b1edd2c0c50988095690',
                    'machine'               => 'TSTM-9688',
                    'suspension_type'       => 'Telescopic Fork',
                    'transmision_type'      => 'Automatic',     
                    'qty'                   => 29,
                ],
                [
                    '_id'                    => '79f8b1edd2c0c59288095690',
                    'machine'               => 'TSTM-1056',
                    'suspension_type'       => 'Telescopic Fork',
                    'transmision_type'      => 'Automatic',     
                    'qty'                   => 60,
                ],
            ];

            $motorcycleVehcilesData = [
                [
                    'source_id'             => '72f8b1edd2c0c50988095690',
                    'source_type'           => Motorcycle::class,
                    'price'                 => 16000000,
                    'years'                 => '2021',
                    'color'                 => 'red',
                ],
                [
                    'source_id'             => '79f8b1edd2c0c50988095690',
                    'source_type'           => Motorcycle::class,
                    'price'                 => 25000000,
                    'years'                 => '2018',
                    'color'                 => 'blue',
                ],
                [
                    'source_id'             => '79f8b1edd2c0c59288095690',
                    'source_type'           => Motorcycle::class,
                    'price'                 => 35000000,
                    'years'                 => '2020',
                    'color'                 => 'black',
                ],
            ];

            foreach ($carData as $car) {
                Car::create($car);
            }

            foreach ($carVehiclesData as $carVehicle) {
                Vehicle::create($carVehicle);
            }

            foreach ($motorcycleData as $motor) {
                Motorcycle::create($motor);
            }

            foreach ($motorcycleVehcilesData as $motorVehicle) {
                Vehicle::create($motorVehicle);
            }

            $session->commitTransaction();
        } catch (\Exception $err) {
            $session->abortTransaction();
            echo $err->getMessage();
        }
    }
}
