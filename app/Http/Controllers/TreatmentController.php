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

        return view('Treatment/view', [
            'treatments' => $treatments,
            'disease' => $disease,
            'hospital' => $hospital,
            'averageCharges' => $averageCharges / $length,
            'averageMedicare' => $averageMedicare / $length,
            'averageTotal' => $averageTotal / $length,
            'averageAdmissions' => floor($averageAdmissions / $length)
        ]);
    }
}