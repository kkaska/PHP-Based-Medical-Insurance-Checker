<?php


namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Disease;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;


class SearchController extends BaseController
{
    public const PAGE_SIZE = 10;        //TODO: there is probably a better place for this

    public function getView()
    {
        return view('search');
    }

    public function search(Request $request)
    {
        session(['user-latitude' => $request->input('user-latitude')]);
        session(['user-longitude' => $request->input('user-longitude')]);
        $url = sprintf('search/list?city=%s&disease=%s&radius=%d',
            $request->input('city'),
            urlencode($request->input('disease')),
            $request->input('radius')
        );

        return redirect($url);
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $city = $request->get('city');
        $radius = $request->get('radius');

        $userLatitude = session()->has('user-latitude') ? (float) session()->get('user-latitude') : null;
        $userLongitude = session()->has('user-longitude') ? (float) session()->get('user-longitude') : null;

        $query = Treatment::searchInRadius($disease, $userLatitude, $userLongitude, $radius);

        if($request->has('cost') && in_array($request->get('cost'), ['ASC', 'DESC'])) {
            $query->orderBy('AverageCharges', $request->get('cost'));
        }

        if($request->has('distance') && in_array($request->get('distance'), ['ASC', 'DESC'])) {
            $query->orderBy('Distance', $request->get('distance'));
        }

        $treatments = $query->paginate(self::PAGE_SIZE);

        return view('disease-list', [
            'treatments' => $treatments,
            'disease' => $disease,
            'city' => $city,
            'radius' => $radius,
            'userLatitude' => $userLatitude,
            'userLongitude' => $userLongitude
        ]);
    }

    /**
     * Function to return diseases based upon a user's current search 
     * Could be refactored to speed up (caching?)
     *
     * @author Finn
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
      
        $result = Disease::where('name', 'LIKE', '%'. $search. '%')->get();
 
        return response()->json($result);
    }
} 
