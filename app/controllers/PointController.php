<?php

class PointController extends BaseController {

    public function closest($latitude, $longitude) {
        $points =array();
        if(is_numeric($latitude)&&is_numeric($longitude)){
        $points = DB::select(DB::raw("SELECT id,primary_city, latitude, longitude, 111.045* DEGREES(ACOS(COS(RADIANS(latpoint)) * COS(RADIANS(latitude)) * COS(RADIANS(longpoint) - RADIANS(longitude)) + SIN(RADIANS(latpoint)) * SIN(RADIANS(latitude)))) AS distance_in_km FROM points JOIN ( SELECT $latitude AS latpoint, $longitude AS longpoint ) AS p ORDER BY distance_in_km LIMIT 15"));
        }return Response::json($points);
        //return "test";
    }

}
