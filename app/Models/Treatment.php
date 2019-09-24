<?php


namespace App\Models;

use App\Http\Controllers\SearchController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Treatment extends Model
{
    protected $table = 'treatmentdetails';
    public $timestamps = false;

    /*
     * Joins the Hospital, Treatment and dRGDefinition tables on Ids and returns a query as a result.
     * */
    public static function search(string $disease, string $city)
    {
        $treatments = Treatment::join('hospital', function ($join) use ($city) {
                $join->on('treatmentdetails.HospitalId', '=', 'hospital.Id')
                    ->where('hospital.City', 'LIKE', '%' . $city . '%');
            })
            ->join('drgdefinition', function ($join) use ($disease) {
                $join->on('treatmentdetails.DrgId', '=', 'drgdefinition.Id')
                    ->where('drgdefinition.Name', 'LIKE', '%' . $disease . '%');
            })
            ->select(
                'drgdefinition.Name as DiseaseName',
                'hospital.Name as HospitalName',
                'hospital.City',
                'treatmentdetails.AverageCoveredCharges',
                'treatmentdetails.Year',
                DB::raw('AVG(treatmentdetails.AverageCoveredCharges) as AverageCharges')
            )
            ->groupBy('drgdefinition.Name')
            ->orderBy('AverageCharges');

        return $treatments;
    }
}