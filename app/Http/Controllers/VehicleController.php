<?php
/**
 * Created by PhpStorm.
 * User: win8.1
 * Date: 12/2/2017
 * Time: 3:24 AM
 */

namespace App\Http\Controllers;


use App\ResponseChema;
use GuzzleHttp;
use Illuminate\Http\Request;
use App\Http\Traits\VehicleTrait;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class VehicleController extends Controller
{
    use VehicleTrait;

    public function vehicle($year, $make, $model = null, Request $request = null)
    {
        $validator = Validator::make(
            ['year' => $year],
            ['year' => 'numeric']
        );

        if ($validator->fails()) {
            return self::$errorResonse;
        }

        $withRating = false;
        if ($request && $request->has('withRating')) {
            $withRating = $request->withRating === 'true' ? true : false;
        }

        return $this->sendGetRequest(
            "https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/$year/make/$make/model/$model?format=json",
            $withRating
        );
    }

    public function vehicleByPost(Request $request)
    {
        return $this->vehicle($request->modelYear, $request->manufacturer, $request->model, $request);
    }

}
