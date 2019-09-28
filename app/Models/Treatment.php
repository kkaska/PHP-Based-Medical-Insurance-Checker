<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Treatment extends Model
{
    use Sortable;
    protected $table = 'treatmentdetails';
    public $timestamps = false;
    public $sortable = ['AverageCoveredCharges'];

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
                'hospital.StreetAddress as HospitalAddress',
                'hospital.City',
                'hospital.Zip as HospitalPostCode',
                'treatmentdetails.AverageCoveredCharges',
                'treatmentdetails.Year',
                DB::raw('AVG(treatmentdetails.AverageCoveredCharges) as AverageCharges')
            )
            ->groupBy('hospital.Name')
            ->orderBy('AverageCharges');

        return $treatments;
    }
}