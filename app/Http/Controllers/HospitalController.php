<?php


namespace App\Http\Controllers;

use App\Hospital;

class HospitalController
{
    public function list()
    {
        $hospitals = Hospital::sortable()->paginate(20);

        return view('hospitals-list', [
            'hospitals' => $hospitals
        ]);
    }
}