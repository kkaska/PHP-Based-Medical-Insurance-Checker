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
        $url = sprintf('search/list?city=%s&disease=%s',
            $request->input('city'),
            $request->input('disease')
        );

        return redirect($url);
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $city = $request->get('city');

        $userLatitude = session()->has('user-latitude') ? session()->get('user-latitude') : -34.397;
        $userLongitude = session()->has('user-longitude') ? session()->get('user-longitude') : 150.644;

        $treatments = Treatment::search($disease, $city)->sortable(['AverageCoveredCharges'])->paginate(10);

        return view('disease-list', [
            'treatments' => $treatments,
            'disease' => $disease,
            'city' => $city,
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
        //Retreive relevant diseases from what the user has typed
        $query = Disease::select("Name")
                ->where("Name","LIKE","%{$request->input('query')}%")
                ->get();

        // Convert the model data into an array of strings
        $data = array();
        foreach($query as $record) {
            $data[] = $record->Name;
        }
   
       return response()->json($data);
    }
} 
