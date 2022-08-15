<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class VehicleTest extends TestCase
{

    /**
     * It tests the get all vehicles endpoint.
     */
    public function test_get_all_vehicles() : void
    {
        $user = User::first();

        $response = $this->actingAs($user, 'api')
        ->get('/api/v1/vehicle');

        $response->assertJsonStructure([
            '*' => [
                'id',
                'color',
                'price',
                'years',
                'vehicles'
            ]
        ]);
        $response->assertStatus(200);
    }

    public function test_get_all_vehicles_with_car_type() : void
    {
        $user = User::first();

        $response = $this->actingAs($user, 'api')
        ->get('/api/v1/vehicle?type=0');
        $response->assertJsonStructure([
            '*' => [
                'id',
                'color',
                'price',
                'years',
                'vehicles' => [
                    'machine',
                    'passenger_capacity',
                    'type',
                    'qty'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }

    public function test_get_all_vehicles_with_motorycycle_type() : void
    {
        $user = User::first();

        $response = $this->actingAs($user, 'api')
        ->get('/api/v1/vehicle?type=1');
        $response->assertJsonStructure([
            '*' => [
                'id',
                'color',
                'price',
                'years',
                'vehicles' => [
                    'machine',
                    'suspension_type',
                    'transmision_type',
                    'qty'
                ]
            ]
        ]);
        $response->assertStatus(200);
    }
}
