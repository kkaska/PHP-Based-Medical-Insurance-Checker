<?php


namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\Disease;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class SearchController extends BaseController
{
    public const PAGE_SIZE = 20;        //TODO: there is probably a better place for this

    public function getView()
    {
        return view('search');
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $city = $request->get('city');
        $treatments = Treatment::search($disease, $city)->sortable(['AverageCoveredCharges'])->paginate(10);

        return view('disease-list', [
            'treatments' => $treatments,
            'disease' => $disease,
            'city' => $city
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
