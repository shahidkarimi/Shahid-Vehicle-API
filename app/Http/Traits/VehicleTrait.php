<?php
/**
 * Created by PhpStorm.
 * User: win8.1
 * Date: 12/3/2017
 * Time: 1:55 AM
 */

namespace App\Http\Traits;

use GuzzleHttp;

trait VehicleTrait
{
    public static $errorResonse = [
        'Count' => '0',
        'Results' => []
    ];

    /**
     * Configure you required attributes from the API and new attribute
     * @var array
     */
    public $resultPropertiesMaping = [
        'Description' => 'VehicleDescription',
        'VehicleId' => 'VehicleId'
    ];
    
    public function sendGetRequest($url, $withRating = false)
    {
        $client = new \GuzzleHttp\Client();
        $res = $client->request('GET', $url);
        $obj = GuzzleHttp\json_decode($res->getBody(), 2);
        return $this->extarctResults($obj, $withRating);
    }

    public function extarctResults($input, $withRating = false)
    {
        $data = [
            'Count' => '0',
            'Results' => []
        ];
        if (isset($input['Count'])) {
            $data['Count'] = $input['Count'];
        }
        if (isset($input['Results'])) {
            foreach ($input['Results'] as $d) {
                array_push($data['Results'], $this->addToResults($d, $withRating));
            }
        }
        return $data;
    }

    public function addToResults($result, $withRating = false)
    {
        $r = [];
        foreach ($this->resultPropertiesMaping as $key => $value) {
            if (array_key_exists($value, $result)) {
                $r[$key] = $result[$value];
            }
        }
        if ($withRating == true) {
            $r['CrashRating'] = $this->getRating($r['VehicleId']);
        }
        return $r;
    }

    public function getRating($vehicleId)
    {
        $rating = "Not Rated";
        $url = "https://one.nhtsa.gov/webapi/api/SafetyRatings/VehicleId/$vehicleId?format=json";
        $results = $this->sendGetRequest($url);
        if ($results) {
            if (isset($results['Results'])) {
                if (array_key_exists('OverallRating', $results['Results'][0])) {
                    $rating = $results['Results'][0]['OverallRating'];
                }
            }
        }
        return $rating;
    }
}