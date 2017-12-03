<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class VehicleTest extends TestCase
{
    /**
     * Tests to verify the API
     *
     * @return void
     */
    public function testAPIOK()
    {
        $this->get('/vehicles/2015/Audi/A3')
            ->seeJson([
                'Count' => 4
            ]);
    }

    public function testJsonStructure()
    {
        $this->get('/vehicles/2015/Audi/A3')
            ->seeJsonStructure([
                'Count',
                'Results' => [
                    [
                        'Description',
                        'VehicleId'
                    ]
                ]
            ]);
    }

    public function testJsonStructureWithRating()
    {
        $this->get('/vehicles/2015/Audi/A3?withRating=true')
            ->seeJsonStructure([
                'Count',
                'Results' => [
                    [
                        'Description',
                        'VehicleId',
                        'CrashRating'
                    ]
                ]
            ]);
    }

    public function testJsonStructurByPost()
    {
        $payLoad = [
            'modelYear' => '2015',
            'manufacturer' => 'Audi',
            'model' => 'A3'
        ];
        $this->post('/vehicles', $payLoad)
            ->seeJsonStructure([
                'Count',
                'Results' => [
                    [
                        'Description',
                        'VehicleId'
                    ]
                ]
            ]);
    }

    public function testInvalidYear()
    {
        $this->get('/vehicles/undefined/Audi/A3')
            ->seeJson([
                'Count' => '0',
                'Results' => []
            ]);
    }

    public function testInvalidGetInput()
    {
        $this->get('/vehicles/Audi/A3/24343')
            ->seeJson([
                'Count' => '0',
                'Results' => []
            ]);
    }
}
