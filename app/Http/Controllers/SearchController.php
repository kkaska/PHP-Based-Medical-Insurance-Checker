<?php


namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SearchController extends BaseController
{
    public function getView()
    {
        return view('search');
    }

    public function list(Request $request)
    {
        $disease = $request->get('disease');
        $city = $request->get('city');

        $treatments = DB::table('treatmentdetails')
            ->join('hospital', function ($join) use ($city) {
                $join->on('treatmentdetails.HospitalId', '=', 'hospital.Id')
                    ->where('hospital.City', 'LIKE', '%' . $city . '%');  //TODO finish this to use $city
            })
            ->join('drgdefinition', function ($join) use ($disease) {
                $join->on('treatmentdetails.DrgId', '=', 'drgdefinition.Id')
                    ->where('drgdefinition.Name', 'LIKE', '%' . $disease . '%');
            })
            ->select('drgdefinition.Name as DiseaseName', 'hospital.Name as HospitalName', 'treatmentdetails.AverageCoveredCharges', 'treatmentdetails.Year')
            ->paginate(20);

        return view('treatments-list', [
            'treatments' => $treatments
        ]);
    }
}