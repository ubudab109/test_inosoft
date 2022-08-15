<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleTransaction;
use Tests\TestCase;

class VehicleSaleTest extends TestCase
{
    /**
     * The above function is a test function that tests the get all list sales function.
     */
    public function test_get_all_list_sales() : void
    {
        $user = User::first();
        $response = $this->actingAs($user,'api')
        ->get('/api/v1/sales');

        $response->assertJsonStructure([
            'success',
            'data' => [
                '*' => [
                    'id',
                    'total_price',
                    'current_stock',
                    'vehicle' => [
                        'years',
                        'price',
                        'color',
                        'vehicle_data' => [
                            'machine',
                            'passenger_capacity',
                            'type',
                        ]
                    ]
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * The above function is a test function that tests the submit sales function.
     */
    public function test_submit_sales() : void
    {
        $vehicles = Vehicle::first();
        $user = User::first();
        $response = $this->actingAs($user, 'api')
        ->post('/api/v1/sales', [
            'vehicle_id' => $vehicles->id,
            'qty'   => 4,
        ]);
        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'total_price',
                'current_stock',
                'vehicle' => [
                    'years',
                    'price',
                    'color',
                    'vehicle_data'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    /**
     * The above function is used to get the sales report by vehicle id.
     */
    public function test_report_sales_by_vehicles_id() : void
    {
        $salesVehicle = VehicleTransaction::first();
        $vehicles = Vehicle::find($salesVehicle->vehicle_id);

        $user = User::first();
        $response = $this->actingAs($user,'api')
        ->get('/api/v1/sales/'.$vehicles->id);

        $response->assertJsonStructure([
            'success',
            'data' => [
                'id',
                'price',
                'years',
                'color',
                'vehicle_data',
                'sales' => [
                    '*' => [
                        '_id',
                        'vehicle_id',
                        'qty',
                        'updated_at',
                        'created_at',
                        'total_price',
                    ]
                ]
            ]
        ]);

        $response->assertStatus(200);
    }
}
