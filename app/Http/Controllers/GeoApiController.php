<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GeoApiController extends Controller
{
    /**
     * Return the country for a specified IP address
     *
     * @param  Request  $request
     * @return false|string
     */
    public function locationByIP(Request $request)
    {
        $ip = $request->input('IP');
        if ($ip) {
            $country = DB::table('geo_ip_country')
                ->select('country_name')
                ->whereRaw('start_ip_integer <= INET_ATON(?) AND end_ip_integer >= INET_ATON(?)', [$ip, $ip])
                ->first();

            return response()->json($country);
        } else {
            return response()->json(['message' => 'Please specify an IP address. Eg. locationByIP?IP=1.0.0.0']);
        }
    }
}
