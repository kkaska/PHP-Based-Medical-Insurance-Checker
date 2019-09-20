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
}