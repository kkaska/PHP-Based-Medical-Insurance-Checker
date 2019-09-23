<?php


namespace App\Http\Controllers;

use App\Models\Treatment;
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
        $treatments = Treatment::search($disease, $city)->paginate(10);

        return view('disease-list', [
            'treatments' => $treatments,
            'disease' => $disease,
            'city' => $city
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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