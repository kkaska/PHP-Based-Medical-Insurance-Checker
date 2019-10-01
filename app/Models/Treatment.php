<?php


namespace App\Models;

use App\Hospital;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class Treatment extends Model
{
    protected $table = 'treatmentdetails';
    public $timestamps = false;

    /*
     * Look up records from the treatment table, for a $disease that is in a hospital in
     * the bounding circle with a center of
     * $latitude and $longitude in a radius $radius (measured in miles).
     * */
    public static function searchInRadius(string $disease, float $latitude, float $longitude, int $radius = 25)
    {
        //TODO: add harvesine as a scope function of the model
        $haversine = "(3959 * acos(cos(radians($latitude)) * cos(radians(hospital.Latitude)) * cos(radians(hospital.Longitude) - radians($longitude)) + sin(radians($latitude)) * sin(radians(hospital.Latitude))))";
        $query = Hospital::
            selectRaw("{$haversine} AS distance")
            ->join('treatmentdetails', function ($join) {
                $join->on('treatmentdetails.HospitalId', '=', 'hospital.Id');
            })
            ->join('drgdefinition', function ($join) use ($disease) {
                $join->on('treatmentdetails.DrgId', '=', 'drgdefinition.Id')
                    ->where('drgdefinition.Name', '=', $disease);
            })
            ->select(
                'drgdefinition.Name as DiseaseName',
                'drgdefinition.Id as DiseaseID',
                'hospital.Id as HospitalID',
                'hospital.Name as HospitalName',
                'hospital.StreetAddress as HospitalAddress',
                'hospital.City',
                'hospital.Zip as HospitalPostCode',
                'treatmentdetails.AverageCoveredCharges',
                'treatmentdetails.Year',
                DB::raw('AVG(treatmentdetails.AverageCoveredCharges) as AverageCharges'),
                DB::raw("{$haversine} as Distance")
            )
            ->groupBy('hospital.Name')
            ->whereRaw("{$haversine} < ?", [$radius]);

        return $query;
    }

}