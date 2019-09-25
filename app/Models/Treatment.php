<?php


namespace App\Models;

use App\Http\Controllers\SearchController;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Treatment extends Model
{
    use Sortable;
    protected $table = 'treatmentdetails';
    public $timestamps = false;
    public $sortable = ['treatmentdetails.AverageCoveredCharges'];

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
                'treatmentdetails.Year'
            );

        return $treatments;
    }
}