<?php


namespace App\Http\Controllers;

use App\Models\Disease;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class SearchController extends BaseController
{
    public function getView()
    {
        return view('search');
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $diseases = Disease::where('Name', 'LIKE', '%' . $disease . '%')->paginate(20);


        return view('disease-list', [
            'diseases' => $diseases
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
        $query = Disease::select("Name")
                ->where("Name","LIKE","%{$request->input('query')}%")
                ->get();

        $data = array();
        foreach($query as $record) {
            $data[] = $record->Name;
        }
   
       return response()->json($data);
    }
} 
