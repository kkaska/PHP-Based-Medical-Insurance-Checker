<?php


namespace App\Http\Controllers;


use App\Hospital;
use App\Models\Disease;
use App\Models\Treatment;
use Illuminate\Http\Request;

class TreatmentController
{
    public function view(Request $request)
    {
        $diseaseID = $request->get('disease');
        $hospitalID = $request->get('hospital');

        $treatments = Treatment::where('DrgId', '=', $diseaseID)
            ->where('HospitalId', '=', $hospitalID)
            ->get();
        $disease = Disease::where('Id', '=', $diseaseID)->first();
        $hospital = Hospital::where('Id', '=', $hospitalID)->first();
        $averageCharges = 0;
        $averageMedicare = 0;
        $averageTotal = 0;
        $averageAdmissions = 0;

        foreach ($treatments as $treatment) {
            $averageCharges += $treatment->AverageCoveredCharges;
            $averageMedicare += $treatment->AverageMedicarePayments;
            $averageTotal += $treatment->AverageTotalPayments;
            $averageAdmissions += $treatment->TotalDischarges;
        }

        $length = count($treatments);
        $lastYear = count($treatments) > 1 ? $treatments[count($treatments) - 1]->Year : null;

        return view('Treatment/view', [
            'diseaseName' => $disease->Name,
            'hospital' => $hospital,
            'averageCharges' => $averageCharges / $length,
            'averageMedicare' => $averageMedicare / $length,
            'averageTotal' => $averageTotal / $length,
            'averageAdmissions' => floor($averageAdmissions / $length),
            'firstYear' => $treatments[0]->Year,
            'lastYear' => $lastYear
        ]);
    }

    public function treatmentInfo(Request $request)
    {
        $diseaseID = $request->get('disease');
        $hospitalID = $request->get('hospital');

        $treatments = Treatment::where('DrgId', '=', $diseaseID)
            ->where('HospitalId', '=', $hospitalID)
            ->get();

        return json_encode($treatments);
    }
}